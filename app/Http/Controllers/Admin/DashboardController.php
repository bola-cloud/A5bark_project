<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\District;
use App\Models\WorkShop;
use App\Models\WorkshopOrder;
use App\Models\WorkShopManager;

use App\Http\Traits\ResponseTemplate;

class DashboardController extends Controller
{
    use ResponseTemplate;

    public function index (Request $request) {
        // get main data in static and ajax
        
        if ($request->get_counts) {
            $clients          = Client::count();
            $workShops        = WorkShop::count();
            $workshopOrders   = WorkshopOrder::count();
            $workShopManagers = WorkShopManager::count();

            $data = [
                'clients'          => $clients, 
                'workShops'        => $workShops,
                'workshopOrders'   => $workshopOrders,
                'workShopManagers' => $workShopManagers,
            ];

            return $this->responseTemplate($data, true, null);
        }

        if ($request->get_workshops) {
            $workshops = WorkShop::query()
            ->select(['id', 'name', 'geo_lat', 'geo_lng'])
            ->adminFilter()
            ->get();
            
            if (isset($request->gove)) $gove = District::find($request->gove);
            
            return $this->responseTemplate(['workshops' => $workshops, 'gove' => isset($gove) ? $gove : null], true, null);
        }

        return view('admin.dashboard.index');
    }

}
