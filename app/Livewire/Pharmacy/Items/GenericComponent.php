<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemGeneric;
use App\Models\Pharmacy\ItemCategory;
use App\Models\Pharmacy\ItemCategoryGroup;
use App\Models\Pharmacy\ItemSubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class GenericComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Generic';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $categoryGroups=[];
    public $categories=[];
    public $subCategories=[];
    public $formSubCategories=[];
    public $searchName, $searchCategoryGroupId, $searchCategoryId, $searchSubCategoryId;
    public $generic_id;
    public $generic_name, $category_id, $sub_category_id;

    /*
     * if query parameters required, add params in $queryString array
     * */

    protected $queryString = ['page' => ['except' => 1]];
    public $auth_role_id;

    public function mount()
    {
        $this->categoryGroups = ItemCategoryGroup::get();
        $this->categories = ItemCategory::get();
        $this->clearSearch();
    }

    public function render()
    {
        return view('livewire.pharmacy.items.generic-component', [
            'rows' => $this->getRecords()
        ]);
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Generic';
        $this->updateMode = false;
        $this->generic_id = null;
        $this->generic_name = null;
        $this->category_id = null;
        $this->sub_category_id = null;
        $this->resetValidation();
    }

    public function searchFilter(){
        $this->search = true;
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchName = $this->searchCategoryGroupId = null;
        $this->searchCategoryId = $this->searchSubCategoryId = null;
    }

    public function changeCateogryGroup()
    {
        $this->categories = ItemCategory::get();
        if($this->searchCategoryGroupId){
            $this->categories = ItemCategory::active()->where('category_group_id',$this->searchCategoryGroupId)->get();
        } 
    }

    public function changeCateogry($is_form=false)
    {
        $this->subCategories = [];
        if($this->searchCategoryId){
            $this->subCategories = ItemSubCategory::active()->where('category_id',$this->searchCategoryId)->get();
        }
        if($is_form && $this->category_id){
            $this->formSubCategories = ItemSubCategory::active()->where('category_id',$this->category_id)->get();
        }
    }

    public function getRecords()
    {
        try {
            return ItemGeneric::select('item_generics.*')
            ->when($this->searchName, function($q){
                $q->where('generic_name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->searchCategoryGroupId, function($q){
                $q->where('category_id', $this->searchCategoryGroupId);
            })
            ->when($this->searchCategoryId, function($q){
                $q->where('category_id',$this->searchCategoryId);
            })
            ->when($this->searchSubCategoryId, function($q){
                $q->where('sub_category_id',$this->searchSubCategoryId);
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
        $this->lightBoxTitle = 'Edit Generic';
        $this->resetValidation();
        $this->updateMode = true;
        $record = ItemGeneric::where('id',$id)->first();
        $this->generic_id = $id;
        $this->generic_name = $record->generic_name;
        $this->category_id = $record->category_id;
        $this->sub_category_id = $record->sub_category_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function customValidationRules($update=false)
    {
        return [
            'generic_name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required'
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
            $validatedData['is_active'] = true;
            ItemGeneric::create($validatedData);

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
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());

        if ($this->generic_id) {
            $record = ItemGeneric::find($this->generic_id);
            $record->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Item Generic Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($record)
    {
        try {
            ItemGeneric::find($record)->delete();
            $this->dispatch('alert-success','Item Generic Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}
