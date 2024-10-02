<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class OrderController extends Controller
{

    function index()
    {
        $orders = Order::with('type')->paginate(10);

        $orders->transform(function ($order) {
            if ($order->type instanceof \App\Models\Tour && $order->type->image) {
                $order->image = $order->type->image->path;
            } elseif ($order->type instanceof \App\Models\Rental && isset($order->type->imagePath)) {
                $order->image = $order->type->imagePath;
            } else {
                $order->image = null; // Set image to null if no image path is found
            }
            return $order;
        });

        return response()->json($orders, 200);
    }

    function session(Request $request)
    {
        $user = auth('sanctum')->user();
        $session = $request->input('session');

        $ordersQuery = Order::where('session', $session)->with('type');

        if ($user) {
            $ordersQuery->orWhere('user_id', $user->id);
        }

        $orders = $ordersQuery->latest()->paginate(10);


        $orders->transform(function ($order) {
            if ($order->type instanceof \App\Models\Tour && $order->type->image) {
                $order->image = $order->type->image->path;
            } elseif ($order->type instanceof \App\Models\Rental && isset($order->type->imagePath)) {
                $order->image = $order->type->imagePath;
            } else {
                $order->image = null; // Set image to null if no image path is found
            }
            return $order;
        });

        return response()->json($orders, 200);
    }

    function store(Request $request)
    {
        $data = $request->all();

        // return response()->json($data);
        // $date = $data['start_date'];
        // return response()->json($data);
        // return response()->json([Carbon::now(), Carbon::now()->utc()]);

        $field = $request->validate([
            // 'start_date' => 'required|datetime',
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string|regex:/^[0-9]{10,13}$/',
            'location' => 'required|string',
            'address' => 'required|string'
        ]);

        $date = Carbon::parse($data['start_date']);
        // return response()->json("success");

        $orderData = [
            'status' => "requested",
            'start_date' => $date,
            'total_price' => $data['total_price'],
            'details' => $data['details'],
            'name' => $field['name'],
            'email' => $field['email'],
            'phone' => $field['phone'],
            'location' => $field['location'],
            'address' => $field['address']
        ];

        if (isset($data['user_id'])) {
            $orderData['user_id'] = $data['user_id'];
        } else {
            $orderData['session'] = $data['session'];
        }

        $order = new Order($orderData);
        $order->type()->associate(Tour::find($data['id']));
        $order->save();

        return response()->json($order);
    }

    function show(Request $request)
    {
        $params = $request->query();
        $slug = $params['id'];
        $type = $params['type'];

        if ($type == "tour") {
            $order = Order::where('slug', $slug)->with('type')->first();
            $order->image = $order->type->image->path;
        }

        return response()->json($order);
    }
}
