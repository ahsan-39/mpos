<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function index(Request $request)
    {
        if(Auth::user()->role_id != 1){
            abort(403);
        }
        
        try{
            $title = 'Manage Users';
            return view('user.index',compact('title'));
        }catch(\Exception $exception){
            session()->flash('alert-danger', $exception->getMessage());
            return redirect()->back()->with('alert-danger', $exception->getMessage());
        }
    }
}
