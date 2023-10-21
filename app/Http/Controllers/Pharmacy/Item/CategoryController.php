<?php

namespace App\Http\Controllers\Pharmacy\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
}
