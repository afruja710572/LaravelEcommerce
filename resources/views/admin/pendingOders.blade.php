@extends('admin.layouts.template')
@section('page_title')
Pending Orders - Single Ecom
@endsection
@section('content')
<div class="container my-5">
    <div class="card p-4">
        <div class="card-title">
           <h2 class="text-center"> Pending Orders</h2>
        </div>
        <div class="card-body">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
          @endif
                <table class="table">
                    <tr>
                        <th>Customer Name</th>
                        <th>Shipping Information</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Will Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($pending_orders as $order)
                    @php
                        $product_info = App\Models\Product::where('id', $order->product_id)->first();
                        $user_info = App\Models\User::where('id', $order->userid)->first();
                    @endphp
                    @if ($product_info && $user_info)
                    <tr>
                        <td>{{ $user_info->name}}</td>
                        <td>
                            <ul>
                                <li>Phone Number - {{$order->shipping_phoneNumber}}</li>
                                <li>City - {{$order->shipping_city}}</li>
                                <li>Postal Code - {{$order->shipping_postalcode}}</li>
                                <li>Address - {{$order->shipping_address}}</li>
                            </ul>
                        </td>
                        <td>{{ $product_info->product_name}}</td>
                        <td>{{ $order->quantity}}</td>
                        <td>{{ $order->total_price}}</td>
                        <td style="color: red;font-weight:bold;">{{ $order->status}}</td>
                        <td>
                           <a href="{{route('orderconfirm', $order->id)}}" class="btn btn-sm btn-success">Confirm</a>
                           <a href="{{route('ordercancel', $order->id)}}" class="btn btn-sm  btn-warning  mt-2">Cancel</a>
                        </td>
                    </tr>
                    @endif
                        
                    @endforeach
                </table>
        </div>
    </div>
</div>
@endsection