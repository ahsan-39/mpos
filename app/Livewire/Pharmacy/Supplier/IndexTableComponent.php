<?php

namespace App\Livewire\Pharmacy\Supplier;

use App\Models\Pharmacy\Supplier as PharmacySupplier;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class IndexTableComponent extends Component

{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Supplier';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $user_id;
    public $rolesList=[];
    public $roles=[];
    public $code, $name, $phone, $email, $address;
    public $searchName, $searchPhone, $searchUsername, $searchRole;

    protected $listeners = [
        'delete' => 'delete',
        'reset-input-fields' => 'resetInputFields'
    ];

    /*
     * if query parameters required, add params in $queryString array
     * */

    protected $queryString = ['page' => ['except' => 1]];
    public $auth_role_id;

   
    public function save()
    {
        $validatedData = $this->validate(
            [
                'code' => 'required',
                'name' => 'required',
                'phone' => 'required',
                //'email' => 'required|email|min:3|max:100|unique:users,email,null,id',
                'address' => 'required',
            ]
        );
            
            $this->dispatch('alert-success','Supplier created successfully.');

    }

}