<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

final class IndexTableComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add User';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $user_id;
    public $rolesList=[];
    public $roles=[];
    public $name, $email, $username, $password, $password_confirmation, $phone, $role_id;
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

    public function mount()
    {
        $this->resetInputFields();
        $this->clearSearch();
        $this->rolesList = Role::active()->where('slug','!=','super-admin')->orderBy('id')->get();
        $this->auth_role_id = Auth::user()->role_id;
    }

    public function render()
    {
        return view('livewire.users.index-table-component', [
            'users' => $this->getUsers()
        ]);
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add User';
        $this->updateMode = false;
        $this->name = $this->email = $this->role_id = null;
        $this->password = $this->password_confirmation = null;
        $this->phone = null;
        $this->username = null;
        $this->roles = [];
        $this->resetValidation();
    }

    public function save()
    {
        try {
            $validatedData = $this->validate(
                [
                    'name' => 'required|min:3|max:30',
                    //'email' => 'required|email|min:3|max:100|unique:users,email,null,id',
                    'username' => 'required|min:3|max:100|unique:users,username,null,id',
                    'password' => 'required|confirmed|min:6',
                    'phone' => 'required',
                    'role_id' => 'required',
                ],
                [
                    'password.required' => 'The password and confirm password fields are required.',
                    'role_id.required' => 'The role field is required.',
                ]
            );
            unset($validatedData['role']);

            //$validatedData['email'] = ($this->email && $this->email != "")?$this->email:"";
            $validatedData['username'] = ($this->username && $this->username != "")?$this->username:"";
            $validatedData['password'] = Hash::make($this->password);
            $validatedData['is_active'] = true;
            $user = User::create($validatedData);

            $this->emit('alert-success','User created successfully.');

            $this->resetInputFields();
            $this->emit('hideModal');

        } catch (\Exception $e){
            if(config('app.debug')){
                $this->emit('alert-danger', $e->getMessage());
            }else{
                $this->emit('alert-danger', 'Something went wrong.');
            }
        }
    }

    public function searchUser(){
        $this->search = true;
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchRole = null;
        $this->searchName = $this->searchUsername = $this->searchUsername = null;
        $this->searchPhone = null;
    }

    public function getUsers()
    {
        try {
            return User::nonAdmin()
            ->with('role')
            ->when($this->auth_role_id == 2, function($q){
                $q->where('parent_id',Auth::user()->id);
            })
            ->when($this->searchName, function($q){
                $q->where('name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->searchPhone, function($q){
                $q->where('phone',$this->searchPhone);
            })
            ->when($this->searchUsername, function($q){
                $q->where('username',$this->searchUsername);
            })
            ->when($this->searchRole, function($q){
                $q->where('role_id',$this->searchRole);
            })
            ->orderBy('id','desc')
            ->paginate($this->perPage);

        } catch (\Exception $e){
            if(config('app.debug')){
                $this->emit('alert-danger', $e->getMessage());
            }else{
                $this->emit('alert-danger', 'Something went wrong.');
            }
        }
    }

    public function clear()
    {
        $this->search = null;
    }

    public function edit($id)
    {
        $this->currentPage = $this->page;
        $this->lightBoxTitle = 'Edit User';
        $this->resetValidation();
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        //$this->email = $user->email;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->role_id = $user->role_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:3|max:30',
            //'email' => 'required|email|min:3|max:100',
            'username' => 'required|username|min:3|max:100',
            'password' => 'nullable|confirmed|min:6',
            'phone' => 'required',
            'role_id' => 'required'
        ],[
            'role_id.required' => 'The role field is required.'
        ]);
        unset($validatedData['username']);
        unset($validatedData['password']);

        if ($this->user_id) {
            $user = User::find($this->user_id);

            if($this->password)
                $validatedData['password'] = Hash::make($this->password);

            $user->update($validatedData);
            $this->updateMode = false;
            $this->emit('alert-success','User Updated Successfully');
            $this->resetInputFields();
            $this->emit('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($user)
    {
        try {
            User::find($user)->delete();
            $this->emit('alert-success','User Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}
