<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
   
    public function create()
    {
       
        $transactions = Transaction::with('holidayPackage')
        ->where('user_id', Auth::id())
        ->where('payment_status', 'pending')->get();

        return view('user.payments.create', compact('transactions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'payment_method' => 'required|in:credit_card,bank_transfer,paypal',
            'amount' => 'required|numeric|min:1',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        if ($request->amount != $transaction->total_price) {
            return redirect()->back()->withErrors(['amount' => 'Jumlah pembayaran harus sesuai dengan total harga transaksi']);
        }

        Payment::create([
            'transaction_id' => $request->transaction_id,
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'payment_status' => 'completed',
        ]);

        $transaction->update([
            'payment_status' => 'paid',
        ]);

        toast('Payment Successfully ','success');


        return redirect()->route('transactions.index');
    }
}
