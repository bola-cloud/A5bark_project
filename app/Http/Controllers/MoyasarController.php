<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use \Moyasar\Facades\Payment;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\Wallet;
use App\Models\WalletCharge;
use App\Http\Traits\NotificationGeneration;

class MoyasarController extends Controller
{
    use NotificationGeneration;

    public function index (Request $request) {
        
        if (!$request->filled('amount')) return view('moyasar.index');

        $user   = auth()->user();
        $token  = $request->token || '12345678';
        $amount = (float) $request->amount;
        // dd($token, $amount, $user);

        return view('moyasar.index', compact('amount', 'token', 'user'));
    }

    public function checkout (Request $request) {
        try {
            
            $user = auth()->user();
            $payment = $request->payment;
            
            WalletCharge::create([
                'user_id' => $user->id,
                'amount'  => $payment['amount'] / 100,
                'status'  => 'waiting',
                'methods' => 'online-payment',
                'description'    => $payment['description'],
                'transaction_id' => $payment['id']
            ]);
    
            return response()->json([], 201);
        } catch (Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }

    }

    public function approve (Request $request) {
        $target_payment = Payment::fetch($request->id);
        $wallet_charge  = WalletCharge::where('transaction_id', $request->id)->where('status', 'waiting')->first();
        
        if (!isset($wallet_charge)) {
            session()->flash('danger', 'failed');
            return view('moyasar.checkout');
        }

        $target_wallet  = $wallet_charge->user->wallet;
        
        if ($target_payment->status === 'paid') {
            $wallet_charge->status = 'paid';
            $wallet_charge->save();

            $target_wallet->valide_balance += $target_payment->amount / 100;
            $target_wallet->save();

            $this->createNotificstion([
                'user_id'   => $target_wallet->user_id,
                'title'     => 'Wallet has been charged successfully',
                'body'      => 'Wallet has been charged successfully with ammount'.$target_payment->amount / 100,
                'ar_title'  => 'تم شحن المحفظة بنجاح',
                'ar_body'   => $target_payment->amount / 100 .'تم شحن المحفظة بنجاح بمبلغ ',
                'type'      => 'charge_wallet'
            ]);

        } else {
            $wallet_charge->status = 'failed';
            $wallet_charge->save();
        }
        
        session()->flash('success', $wallet_charge->status);
        return view('moyasar.checkout');
    }

    public function transactionWebHock (Request $request) {
        /**
         * @DESC    Here we recive the moyaser webhock transactions updates
         * @PARAMS  The request should consist of the payment id & pass key
         * 
         * @ACTION  
         * 1- Fetch the transaction record from moyaser api ... 
         * 2- Create a WalletCharge record from moyaser transaction record
         * 3- If the the transaction status is paid, add amount in the wallet
         * 
         * */ 
        
        
        $validator = Validator::make($request->all(), [
            'data'          => 'required',
            'secret_token'  => 'required',
        ]);
        
        if ($validator->fails() || $request->secret_token != env('SECRET_TOKEN')) {
            return response()->json(['success' => false], 403);
        }
        
        $order_id        = $request->data['id'];
        $moyaser_payment = null;
        
        try {
            $moyaser_payment = Payment::fetch($order_id);
        } catch (Exception $th) {
            return response()->json(['success' => false], 403);
        }
        
        if (!isset($moyaser_payment)) {
            return response()->json(['success' => false], 403);
        }

        try {
            DB::beginTransaction();
            
            $user_id         = $moyaser_payment->metadata['user_id'];
            
            $wallet_charge = WalletCharge::create([
                'user_id'        => $user_id,
                'amount'         => $moyaser_payment->amount / 100,
                'status'         => $moyaser_payment->status,
                'methods'        => 'online-payment',
                'description'    => $moyaser_payment->description,
                'transaction_id' => $moyaser_payment->id
            ]);

            if ($moyaser_payment->status == 'paid') {
                $wallet = Wallet::where('user_id', $user_id)->first();

                $wallet->valide_balance += $moyaser_payment->amount / 100;
                $wallet->save();
            }

            DB::commit();
        } catch (Exception $th) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => json_decode($th)], 403);
        }

        return response()->json(['success' => true], 201);

    }
    
}
