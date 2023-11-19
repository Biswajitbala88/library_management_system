<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('book')->get();
        $orders->each(function ($order) {
            $order->order_type = $order->order_type == '1' ? 'Buy' : 'Rent';
        });
        return view('order.list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        // dd($book);
        return view('order.edit')->with('book', $book);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $order = new Order();
        $user = Auth::user();
        // dd($user->id);
        $order->book_id = $request->book_id;
        $order->qty = $request->qty;
        $order->order_date = $request->order_date;
        $order->order_type = $request->order_type;
        $order->status = $request->status;
        $order->invoice_no = $request->invoice_no;
        $order->inv_date = $request->inv_date;
        $order->total_amt = $request->total_amt;
        $order->address = $request->address;
        $order->user_id = $user->id;
        $order->save();
        return redirect()->route('order.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $orders = Order::with('book')->get();
        return view('order.update')->with('order', $order);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order = new Order();
        $user = Auth::user();
        // dd($user->id);
        $order->book_id = $request->book_id;
        $order->qty = $request->qty;
        $order->order_date = $request->order_date;
        $order->order_type = $request->order_type;
        $order->status = $request->status;
        $order->invoice_no = $request->invoice_no;
        $order->inv_date = $request->inv_date;
        $order->total_amt = $request->total_amt;
        $order->address = $request->address;
        $order->user_id = $user->id;
        $order->save();
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status; // Update the status field
        $order->save(); // Save the updated order

        return redirect()->route('order.index'); // Redirect to the order index page
    }

}
