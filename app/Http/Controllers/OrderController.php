<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; 


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
        $orders->each(function ($order) {
            $order->status = $order->status == 'pending' ? 'Pending' : 'Delivered';
        });
        $orders->each(function ($order) {
            $order->payment_status = $order->payment_status == 'paid' ? 'Paid' : 'Unpaid';
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
        // dd($request->all());
        $order->book_id = $request->book_id;
        $order->qty = $request->qty;
        $order->order_date = $request->order_date;
        $order->order_type = $request->order_type;
        $order->status = $request->status;
        $order->invoice_no = $request->invoice_no;
        $order->inv_date = $request->inv_date;
        $order->total_amt = $request->total_amt;
        $order->address = $request->address;
        $order->payment_status = $request->payment_status;
        if($request->payment_status == 'paid'){
            $order->transaction_id = 'TRX' . date('dy'). str_pad(mt_rand(1, 9999), 6, '0', STR_PAD_LEFT);
        }else{
            $order->transaction_id = '';
        }
        // dd($order->transaction_id);
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
        $order->payment_status = $request->payment_status;
        if($request->payment_status == 'paid'){
            $order->transaction_id = 'TRX' . date('dy'). str_pad(mt_rand(1, 9999), 6, '0', STR_PAD_LEFT);
        }else{
            $order->transaction_id = '';
        }
        $order->user_id = $user->id;
        $order->save();
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function generatePDF()
    {
        $invoiceData = [
            'invoiceNumber' => 'INV-12345',
            'invoiceDate' => date('Y-m-d'),
            'items' => [
                ['description' => 'Item 1', 'quantity' => 2, 'price' => 25],
                ['description' => 'Item 2', 'quantity' => 1, 'price' => 40],
                // Add more items as needed
            ],
            // Calculate total amount
            'totalAmount' => 2 * 25 + 1 * 40,
        ];

        $pdf = PDF::loadView('pdf.sample', $invoiceData);

        // Generate a unique file name
        $fileName = 'sample_' . time() . '.pdf';

        // Save the PDF to the storage path (or any desired location)
        $pdf->save(storage_path('app/public/' . $fileName));

        // Return the file path or a response with the file as an attachment
        return response()->download(storage_path('app/public/' . $fileName), $fileName);
    }
}
