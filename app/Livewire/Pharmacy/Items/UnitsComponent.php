<?php

namespace App\Livewire\Pharmacy\Items;

use Livewire\Component;
use App\Models\Pharmacy\ItemCategoryGroup;
use App\Models\Pharmacy\ItemUnitOfMeasure;
use Livewire\WithPagination;

class UnitsComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Item Unit';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $categoryGroups=[];
    public $searchName, $searchCategoryGroupId;
    public $uom_id;
    public $uom_name, $category_group_id, $child_uom_id, $child_uom_value;

    /*
     * if query parameters required, add params in $queryString array
     * */

    protected $queryString = ['page' => ['except' => 1]];
    public $auth_role_id;

    public function mount()
    {
        $this->categoryGroups = ItemCategoryGroup::get();
        $this->clearSearch();
    }
    public function render()
    {
        return view('livewire.pharmacy.items.units-component', [
            'rows' => $this->getRecords(),
            'subUnits' => ItemUnitOfMeasure::whereNull('item_unit_of_measures.child_uom_id')
                        ->when($this->category_group_id, function ($q) {
                            return $q->where('category_group_id', $this->category_group_id);
                        })->get(),
        ]);
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Item Unit';
        $this->updateMode = false;
        $this->uom_id = null;
        $this->uom_name = null;
        $this->category_group_id = null;
        $this->child_uom_id = null;
        $this->child_uom_value = null;
        $this->resetValidation();
    }

    public function searchFilter(){
        $this->search = true;
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchName = $this->searchCategoryGroupId = null;
    }

    public function getRecords()
    {
        try {
            return ItemUnitOfMeasure::select('item_unit_of_measures.*')
            ->when($this->searchName, function($q){
                $q->where('uom_name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->searchCategoryGroupId, function($q){
                $q->where('category_group_id', $this->searchCategoryGroupId);
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
        $this->lightBoxTitle = 'Edit Item Unit';
        $this->resetValidation();
        $this->updateMode = true;
        $record = ItemUnitOfMeasure::where('id',$id)->first();
        $this->uom_id = $id;
        $this->uom_name = $record->uom_name;
        $this->category_group_id = $record->category_group_id;
        $this->child_uom_id = $record->child_uom_id;
        $this->child_uom_value = $record->child_uom_value;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function customValidationRules($update=false)
    {
        return [
            'uom_name' => 'required',
            'category_group_id' => 'required',
            'child_uom_id' => 'nullable',
            'child_uom_value' => 'nullable'
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
            ItemUnitOfMeasure::create($validatedData);

            $this->dispatch('alert-success','Item unit created successfully.');

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
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());

        if ($this->generic_id) {
            $record = ItemUnitOfMeasure::find($this->generic_id);
            $record->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Item Unit Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($record)
    {
        try {
            ItemUnitOfMeasure::find($record)->delete();
            $this->dispatch('alert-success','Item Unit Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}
