<?php

namespace App\Http\Controllers;

use App\Models\HolidayPackages;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($holidayPackageId)
    {
        $holidayPackage = HolidayPackages::findOrFail($holidayPackageId);


        $existingReview = Review::where('holiday_package_id', $holidayPackageId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {

            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk paket ini.');
        }

        return view('user.reviews.create', compact('holidayPackage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_package_id' => 'required|exists:holiday_packages,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

         Review::create([
            'user_id' => Auth::id(),
            'holiday_package_id' => $request->holiday_package_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        toast('successfully create review', 'success');
        return redirect()->route('transactions.index');
    }
}
