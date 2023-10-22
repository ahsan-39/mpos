<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemSizeSpecification;
use Livewire\Component;
use Livewire\WithPagination;

class SizeSpecificationComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Size Specification';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $item_size_specification_id;
    public $sizeSpecificationName=[];
    public $size_specification_name;
    public $searchSizeSpecification;


    /*
     * if query parameters required, add params in $queryString array
     * */

     protected $queryString = ['page' => ['except' => 1]];
     public $auth_role_id;

     public function mount()
     {
         $this->resetInputFields();
     }
 
     public function render()
     {
         return view('livewire.pharmacy.items.size-specification-component', [
             'rows' => $this->getRecords()
         ]);
     }

     public function searchFilter(){
        $this->search = true;
    }

     public function clearSearch(){
        $this->search = false;
        $this->searchSizeSpecification = null;
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Item Size Specification';
        $this->updateMode = false;
        $this->size_specification_name = null;
        $this->resetValidation();
    }

    public function getRecords()
    {
        try {
            return ItemSizeSpecification::select('item_size_specifications.*')
            ->when($this->searchSizeSpecification, function($q){
                $q->where('size_specification_name', 'LIKE', "%{$this->searchSizeSpecification}%");
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

    public function customValidationRules($update=false)
    {
        return [
            'size_specification_name' => 'required|min:3',
        ];
    }

    public function customValidationMessages($update=false)
    {
        return [];
    }

    public function save()
    {
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());
        try {
            ItemSizeSpecification::create($validatedData);

            $this->dispatch('alert-success','Item Size Specification created successfully.');

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
    public function edit($id)
    {
        $this->currentPage = $this->getPage();
        $this->lightBoxTitle = 'Edit Item Strength';
        $this->resetValidation();
        $this->updateMode = true;
        $record = ItemSizeSpecification::where('id',$id)->first();
        $this->item_size_specification_id = $id;
        $this->size_specification_name = $record->size_specification_name;
    }

    public function update()
    {
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());

        if ($this->item_size_specification_id) {
            $record = ItemSizeSpecification::find($this->item_size_specification_id);
            $record->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Item Size Specification Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($user)
    {
        try {
            ItemSizeSpecification::find($user)->delete();
            $this->dispatch('alert-success','Dosage Route Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}