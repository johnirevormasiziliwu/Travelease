<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\HolidayPackages;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
   
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('user.transactions.index', compact('transactions'));
    }

   
    public function create($holidayPackageId)
    {
        $holidayPackage = HolidayPackages::findOrFail($holidayPackageId);
        return view('user.transactions.create', compact('holidayPackage'));
    }

    public function store(Request $request)
{
   
    $request->validate([
        'holiday_package_id' => 'required|exists:holiday_packages,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $holidayPackage = HolidayPackages::findOrFail($request->holiday_package_id);

   
    $transaction = new Transaction([
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);

    
    $totalPrice = $holidayPackage->price * $transaction->duration_in_days;

   
    $transaction = Transaction::create([
        'user_id' => Auth::id(),
        'holiday_package_id' => $request->holiday_package_id,
        'transaction_date' => now(),
        'start_date' => $startDate,
        'end_date' => $endDate,
        'total_price' => $totalPrice,
        'payment_status' => 'pending',
    ]);

    toast('Holiday Package booking succesfully ','success');
   
    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat');
}
}
