<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Stock Listing';
        return view('pharmacy.stock.index', compact('title'));
    }

    public function summary()
    {
        $title = 'Stock Summary Report';
        return view('pharmacy.stock.summary', compact('title'));
    }
}
