<?php

namespace App\Http\Controllers;

use App\Models\HolidayPackage;
use App\Models\HolidayPackages;
use Illuminate\Http\Request;

class HolidayPackagesController extends Controller
{
    public function index()
    {
        $holidayPackages = HolidayPackages::all();
        return view('user.holiday_packages.index', compact('holidayPackages'));
    }

    public function show($id)
    {
        $holidayPackage = HolidayPackages::findOrFail($id);
        return view('user.holiday_packages.show', compact('holidayPackage'));
    }
}
