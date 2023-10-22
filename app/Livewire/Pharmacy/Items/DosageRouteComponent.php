<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemDosageRoute;
use Livewire\Component;
use Livewire\WithPagination;

class DosageRouteComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Dosage Form';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $itemDosageRoute_id;
    public $dosageRouteName=[];
    public $dosage_route_name;
    public $searchDosageRouteName;


    /*
     * if query parameters required, add params in $queryString array
     * */

     protected $queryString = ['page' => ['except' => 1]];
     public $auth_role_id;

     public function mount()
     {
         $this->dosageRouteName = ItemDosageRoute::get();
         $this->resetInputFields();
     }
 
     public function render()
     {
         return view('livewire.pharmacy.items.dosage-route-component', [
             'rows' => $this->getRecords()
         ]);
     }

     public function searchFilter(){
        $this->search = true;
    }

     public function clearSearch(){
        $this->search = false;
        $this->searchDosageRouteName = null;
    }

    public function resetInputFields(){
        $this->lightBoxTitle = 'Add Dosage Route';
        $this->updateMode = false;
        $this->dosage_route_name = null;
        $this->resetValidation();
    }

    public function getRecords()
    {
        try {
            return ItemDosageRoute::select('item_dosage_routes.*')
            ->when($this->searchDosageRouteName, function($q){
                $q->where('dosage_route_name', 'LIKE', "%{$this->searchDosageRouteName}%");
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
            'dosage_route_name' => 'required',
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
            ItemDosageRoute::create($validatedData);

            $this->dispatch('alert-success','Dosage Route created successfully.');

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
        $this->lightBoxTitle = 'Edit Dosage Route';
        $this->resetValidation();
        $this->updateMode = true;
        $record = ItemDosageRoute::where('id',$id)->first();
        $this->itemDosageRoute_id = $id;
        $this->dosage_route_name = $record->dosage_route_name;
    }

    public function update()
    {
        $validatedData = $this->validate($this->customValidationRules(),$this->customValidationMessages());

        if ($this->itemDosageRoute_id) {
            $record = ItemDosageRoute::find($this->itemDosageRoute_id);
            $record->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Dosage Route Updated Successfully');
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
            ItemDosageRoute::find($user)->delete();
            $this->dispatch('alert-success','Dosage Route Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}