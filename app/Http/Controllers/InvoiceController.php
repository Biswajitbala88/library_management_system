<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderWithUser = $order->load('user');
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('invoice.invoice', ['order' => $orderWithUser]);
        $fileName = $order->invoice_no;
        return $pdf->stream($fileName.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function generateInvoice($orderId, $userId)
    {
        $existingInvoice = Invoice::where('order_id', $orderId)->first();
        if ($existingInvoice) {
            return $existingInvoice;
        }

        $invoice = new Invoice();
        $invoice->order_id = $orderId;
        $invoice->user_id = $userId;
        $invoice->invoice_date = date('Y-m-d');
        $invoice->invoice_no = 'INV' . date('dy'). str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        // dd($invoice->invoice_no);
        // Save the invoice
        $invoice->save();
        
        // Additional logic for generating invoices
        return $invoice;
    }

    public function getInvoice($orderId,)
    {
        $invoiceinfo = Invoice::where('order_id', $orderId)->first();
        dd($invoiceinfo);
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
