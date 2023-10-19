<?php

namespace App\Livewire\Pharmacy\Supplier;

use App\Models\Pharmacy\Supplier;
use Livewire\Component;
use Livewire\WithPagination;
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
    public $supplier_id;
    public $rolesList=[];
    public $roles=[];
    public $code, $name, $phone, $email, $address;
    public $searchName, $searchPhone, $searchCode;

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
        return view('livewire.pharmacy.supplier.index-table-component', [
            'rows' => $this->getRecords()
        ]);
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Supplier';
        $this->updateMode = false;
        $this->name = $this->email = $this->code = null;
        $this->phone = null;
        $this->address = null;
        $this->resetValidation();
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchName = $this->searchCode = null;
        $this->searchPhone = null;
    }

    public function getRecords()
    {
        try {
            return Supplier::select('suppliers.*')
            ->when($this->searchName, function($q){
                $q->where('name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->searchPhone, function($q){
                $q->where('phone',$this->searchPhone);
            })
            ->when($this->searchCode, function($q){
                $q->where('code',$this->searchCode);
            })
            ->orderBy('id','desc')
            ->paginate($this->perPage);

        } catch (\Exception $e){
            if(config('app.debug')){
                $this->dispatch('alert-danger', $e->getMessage());
            }else{
                $this->dispatch('alert-danger', 'Something went wrong.');
            }
        }
    }

    public function clear()
    {
        $this->search = null;
    }

    public function edit($id)
    {
        $this->currentPage = $this->getPage();
        $this->lightBoxTitle = 'Edit Supplier';
        $this->resetValidation();
        $this->updateMode = true;
        $supplier = Supplier::where('id',$id)->first();
        $this->supplier_id = $id;
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->code = $supplier->code;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function save()
    {
        $validatedData = $this->validate(
            [
                'code' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'nullable|email|min:3|max:100',
                'address' => 'nullable',
            ]
        );
            
            $this->dispatch('alert-success','Supplier created successfully.');

    }

}