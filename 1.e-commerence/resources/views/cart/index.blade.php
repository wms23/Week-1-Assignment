@extends('layouts.main')

@section('content')

    <cart-list>
    @foreach($items as $item)
        <cart-item 
            image_url="{{$item->product->image_url}}"
            price="{{$item->product->price}}"
            qty="{{$item->qty}}">
            {{$item->product->name}}
        </cart-item>
    @endforeach
    </cart-list>
    <div class="col-1 border mt-3">
        <div class="form-group mt-3">
            <label for="coupon">Coupon Code</label>
            <input type="text" class="form-control" id="coupon" aria-describedby="couponHelp">
            <small id="couponHelp" class="form-text text-muted">Please enter the coupon code to get great discounts.</small>
        </div>
        <div class="mb-3">
            Total : <span class="font-weight-bold text-success"> {{ "xxx" }} USD<span>
        </div>
        <button type="submit" class="btn btn-primary">Checkout</button>
    </div>
    
@endsection
