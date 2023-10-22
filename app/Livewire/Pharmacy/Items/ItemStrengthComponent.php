<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemStrength;
use Livewire\Component;
use Livewire\WithPagination;

class ItemStrengthComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Item Strength';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $itemStrength_id;
    public $strengthName=[];
    public $strength_name;
    public $searchStrengthName;


    /*
     * if query parameters required, add params in $queryString array
     * */

     protected $queryString = ['page' => ['except' => 1]];
     public $auth_role_id;

     public function mount()
     {
         $this->strengthName = ItemStrength::get();
         $this->resetInputFields();
     }
 
     public function render()
     {
         return view('livewire.pharmacy.items.item-strength-component', [
             'rows' => $this->getRecords()
         ]);
     }

     public function searchFilter(){
        $this->search = true;
    }

     public function clearSearch(){
        $this->search = false;
        $this->searchStrengthName = null;
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Item Strength Name';
        $this->updateMode = false;
        $this->strength_name = null;
        $this->resetValidation();
    }

    public function getRecords()
    {
        try {
            return ItemStrength::select('item_strength_names.*')
            ->when($this->searchStrengthName, function($q){
                $q->where('strength_name', 'LIKE', "%{$this->searchStrengthName}%");
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
            'strength_name' => 'required|min:3',
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
            ItemStrength::create($validatedData);

            $this->dispatch('alert-success','Item Strength created successfully.');

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
        $record = ItemStrength::where('id',$id)->first();
        $this->itemStrength_id = $id;
        $this->strength_name = $record->strength_name;
    }

    public function update()
    {
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());

        if ($this->itemStrength_id) {
            $record = ItemStrength::find($this->itemStrength_id);
            $record->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Item Strength Updated Successfully');
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
            ItemStrength::find($user)->delete();
            $this->dispatch('alert-success','Dosage Route Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}