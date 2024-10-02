<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $orders = Order::where('session', $data['session'])->get();
        // return response()->json($orders);

        if ($request->input('auth') == "google") {
            $data = $request->all();
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                $user = User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'] ?? null,
                    'email' => $data['email'],
                    'email_verified_at' => Carbon::now(),
                    'password' => bcrypt(Str::random(16))
                ]);
            }
        } else {

            $field = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|confirmed'
            ]);

            $user = User::create([
                'first_name' => $field['first_name'],
                'last_name' => $field['last_name'],
                'email' => $field['email'],
                'password' => bcrypt($field['password'])
            ]);

            $user = $user->fresh();


            if ($orders) {
                foreach ($orders as $order) {
                    $order->user_id = $user->id;
                    $order->session = null;
                    $order->save();
                }
            }
        }

        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        // return response()->json($request->all(), 401);

        $field = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $field['email'])->first();

        if (!$user || !Hash::check($field['password'], $user->password)) {
            return response()->json(['message' => 'Bad credentials'], 401);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $data = $request->all();
        $orders = Order::where('session', $data['session'])->get();

        if ($orders) {
            foreach ($orders as $order) {
                $order->user_id = $user->id;
                $order->session = null;
                $order->save();
            }
        }

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($response, 201);
    }

    public function user(Request $request)
    {
        // return response()->json($request->all(), 200);
        // $token = $request->bearerToken();
        // return response()->json($token, 200);
        $user = Auth::user();
        // $user = "dd";
        return response()->json($user, 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
