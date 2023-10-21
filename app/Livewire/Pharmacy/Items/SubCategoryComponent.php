<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemSubCategory;
use App\Models\Pharmacy\ItemCategory;
use App\Models\Pharmacy\ItemCategoryGroup;
use Livewire\Component;
use Livewire\WithPagination;

class SubCategoryComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Sub Category';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $subCategory_id;
    public $rolesList=[];
    public $roles=[];
    public $categoryGroups=[];
    public $categories=[];
    public $subCategories=[];
    public $sub_category_name, $category_id;
    public $searchSubCategoryName, $searchCategoryId, $searchCategoryGroupId;

    /*
     * if query parameters required, add params in $queryString array
     * */

    protected $queryString = ['page' => ['except' => 1]];
    public $auth_role_id;

    public function mount()
    {
        $this->categoryGroups = ItemCategoryGroup::get();
        $this->categories = ItemCategory::get();
        $this->subCategories = ItemSubCategory::get();
        $this->resetInputFields();
        $this->clearSearch();
    }

    public function render()
    {
        return view('livewire.pharmacy.items.sub-category-component', [
            'rows' => $this->getRecords()
        ]);
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Sub Category';
        $this->updateMode = false;
        $this->sub_category_name = null;
        $this->category_id = null;
        $this->resetValidation();
    }

    public function searchFilter(){
        $this->search = true;
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchSubCategoryName = $this->searchCategoryId = $this->searchCategoryGroupId = null;
    }

    public function getRecords()
    {
        try {
            return ItemSubCategory::select('item_sub_categories.*')
            ->when($this->searchSubCategoryName, function($q){
                $q->where('sub_category_name', 'LIKE', "%{$this->searchSubCategoryName}%");
            })

            ->when($this->searchCategoryId, function($q){
                $q->where('category_id',$this->searchCategoryId);
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
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function save()
    {
        $validatedData = $this->validate(
            [
                'category_id' => 'required',
                'sub_category_name' => 'required',
            ],
        );
        try {
            $validatedData['is_active'] = true;
            ItemSubCategory::create($validatedData);

            $this->dispatch('alert-success','Item Sub Category created successfully.');

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
        $this->lightBoxTitle = 'Edit Sub Category';
        $this->resetValidation();
        $this->updateMode = true;
        $itemSubCategory = ItemSubCategory::where('id',$id)->first();
        $this->subCategory_id = $id;
        $this->sub_category_name = $itemSubCategory->sub_category_name;
        $this->category_id = $itemSubCategory->category_id;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'sub_category_name' => 'required|min:3|max:100',
            'category_id' => 'required',
        ],[]);

        if ($this->subCategory_id) {
            $itemSubCategory = ItemSubCategory::find($this->subCategory_id);
            $itemSubCategory->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Sub Category Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($user)
    {
        try {
            ItemSubCategory::find($user)->delete();
            $this->dispatch('alert-success','Sub Category Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}
