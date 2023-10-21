<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemCategory;
use App\Models\Pharmacy\ItemCategoryGroup;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $perPage=10;
    public $search=false;
    public $categoryGroups=[];
    public $searchName, $categoryGroupId;

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
        return view('livewire.pharmacy.items.category-component', [
            'rows' => $this->getRecords()
        ]);
    }

    public function searchFilter(){
        $this->search = true;
    }

    public function clearSearch(){
        $this->search = false;
        $this->searchName = $this->categoryGroupId = null;
    }

    public function getRecords()
    {
        try {
            return ItemCategory::select('item_categories.*')
            ->when($this->searchName, function($q){
                $q->where('category_name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->categoryGroupId, function($q){
                $q->where('category_group_id',$this->categoryGroupId);
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
}
