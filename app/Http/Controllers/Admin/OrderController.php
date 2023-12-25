<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $pending_orders = Order::where('status','pending')->latest()->get();
        return view("admin.pendingOders", compact('pending_orders'));
    }
    public function CompletedOrder()
    {
        $completed_orders = Order::where('status','completed')->latest()->get();
        return view("admin.completedOders", compact('completed_orders'));
    }

    public function OrderCancel($id)
    {
        Order::where('id',$id)->update([
            'status' => 'cancel'
        ]);
        return redirect()->route('pendingOrder')->with('message','Order Canceled successfully!');
    }

    public function CanceledOrder(){
        $canceled_orders = Order::where('status','cancel')->latest()->get();
        return view("admin.cancelorders", compact('canceled_orders'));
    }
    public function OrderConfirm($id)
    {
        Order::where('id',$id)->update([
            'status' => 'completed'
        ]);
        return redirect()->route('pendingOrder')->with('message','Order Confirm successfully!');
    }
}
