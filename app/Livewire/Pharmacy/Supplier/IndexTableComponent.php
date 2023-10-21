<?php

namespace App\Livewire\Pharmacy\Supplier;

use App\Models\Pharmacy\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function searchFilter(){
        $this->search = true;
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
            ],
            [
                'password.required' => 'The password and confirm password fields are required.'
            ]
        );
        try {
            $validatedData['is_active'] = true;
            Supplier::create($validatedData);

            $this->dispatch('alert-success','Supplier created successfully.');

            $this->resetInputFields();
            $this->dispatch('hideModal');

        } catch (\Exception $e){
            if(config('app.debug')){
                $this->dispatch('alert-danger', $e->getMessage());
            }else{
                $this->dispatch('alert-danger', 'Something went wrong.');
            }
        }
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'nullable|email',
            'code' => 'required|min:3|max:100',
            'phone' => 'required',
            'address' => 'nullable'
        ],[]);

        if ($this->supplier_id) {
            $supplie = Supplier::find($this->supplier_id);
            $supplie->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Supplier Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($user)
    {
        try {
            Supplier::find($user)->delete();
            $this->dispatch('alert-success','Supplier Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }

}