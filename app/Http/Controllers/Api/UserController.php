<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:ذكر,انثي',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the picture
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle the picture upload
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('user_images', 'media');
            $picturePath = 'media/' . $picturePath;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'category' => 'user', // Default category
            'is_active' => true, // Default value for is_active
            'picture' => $picturePath, // Save the picture path
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'data' => $user
        ], 201);
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User account deleted successfully.'], 200);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // $all= $request->all();
        // return $all;
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:ذكر,انثي',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle the picture upload
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('user_images', 'media');
            $user->picture = 'media/' . $picturePath;
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email ?: $user->email;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate ?: $user->birthdate;
        $user->gender = $request->gender ?: $user->gender;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('password');

        $user = User::where('email', $request->email_or_phone)
                    ->orWhere('phone', $request->email_or_phone)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }
}
