<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with('items.product')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order, Request $request)
    {

        return view('user.orders.show', ['order' => $order->load('items.product')]);
    }
}
