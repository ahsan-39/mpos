<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function categories()
    {
        $title = 'Manage Categories';
        return view('pharmacy.item.category-index', compact('title'));
    }

    public function subCategories()
    {
        $title = 'Manage Sub Categories';
        return view('pharmacy.item.sub-category-index', compact('title'));
    }

    public function generic()
    {
        $title = 'Manage Item Generic';
        return view('pharmacy.item.generic-index', compact('title'));
    }
    
    public function dosageForms()
    {
        $title = 'Manage Item Dosage Forms';
        return view('pharmacy.item.dosage-form-index', compact('title'));
    }
    public function dosageRoutes()
    {
        $title = 'Manage Item Dosage Routes';
        return view('pharmacy.item.dosage-route-index', compact('title'));
    }
    public function strength()
    {
        $title = 'Manage Item Strength';
        return view('pharmacy.item.item-strength-index', compact('title'));
    }
}
