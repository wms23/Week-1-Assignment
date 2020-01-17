<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Transation;
use App\TransationDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->check()) {

            $customer = auth()->user();
            $current_cart = $customer->active_cart;

            $transaction = new \App\Transation();
            $transaction->cart_id = auth()->user()->active_cart->id;
            $transaction->customer_id = $current_cart->customer_id;
            $transaction->total_cost = $request->total_price;
            $transaction->save();

            $transaction = $transaction->id;


            foreach ($current_cart->items as $item) {

                $transactionDetail = new \App\TransationDetail();
                $transactionDetail->transation_id = $transaction;
                $transactionDetail->product_id = $item->product_id;
                $transactionDetail->qty = $item->qty;
                $transactionDetail->cost = $item->product->price;
                $transactionDetail->save();

            }

            $cart = Cart::where('id', auth()->user()->active_cart->id)
                ->update(['completed_at' => Carbon::Now()]);


            $cartItem = CartItem::where('cart_id', auth()->user()->active_cart->id)
                ->update(['completed_at' => Carbon::Now()]);

            $subTotal = $request->total_price;
            $orderDetails = TransationDetail::where('transation_id', $transaction)->get();

            return view('order.index', compact(['orderDetails', 'subTotal']));

        } else {
            dd("Need to redriect to the login page");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Transation $transation
     * @return \Illuminate\Http\Response
     */
    public function show(Transation $transation)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Transation $transation
     * @return \Illuminate\Http\Response
     */
    public function edit(Transation $transation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Transation $transation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transation $transation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Transation $transation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transation $transation)
    {
        //
    }
}
