@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
<p style="color: greenyellow;">Welcome {{Auth::user()->name}}</p>
<p>Your Completed Orders</p>
@if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<table class="table">
    <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
        @foreach ($completed_orders as $order)
        @php
            $product_info = App\Models\Product::where('id', $order->product_id)->first();
        @endphp
        @if ($product_info)
        <tr>
            <td><img style="height:60px;" src="{{ asset($product_info->product_img)}}"></td>
            <td>{{ $product_info->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->total_price }}</td>
        </tr>
        @endif
            
        @endforeach
    
</table> 
@endsection