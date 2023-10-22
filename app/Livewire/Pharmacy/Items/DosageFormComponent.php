<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemDosageForm;
use App\Models\Pharmacy\ItemDosageFormType;
use Livewire\Component;
use Livewire\WithPagination;

class DosageFormComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Dosage Form';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;
    public $itemDosageForm_id;
    public $dosageFormName=[];
    public $dosageFormTypeName=[];
    public $dosage_form_name, $dosage_form_type_id;
    public $searchDosageFormName, $searchDosageFormTypeId;


    /*
     * if query parameters required, add params in $queryString array
     * */

     protected $queryString = ['page' => ['except' => 1]];
     public $auth_role_id;
 
     public function mount()
     {
         $this->dosageFormName = ItemDosageForm::get();
         $this->dosageFormTypeName = ItemDosageFormType::get();
         $this->resetInputFields();
     }
 
     public function render()
     {
         return view('livewire.pharmacy.items.dosage-form-component', [
             'rows' => $this->getRecords()
         ]);
     }

     public function searchFilter(){
        $this->search = true;
    }

     public function clearSearch(){
        $this->search = false;
        $this->searchDosageFormName = $this->searchDosageFormTypeId = null;
    }

     public function resetInputFields(){
        $this->lightBoxTitle = 'Add Dosage Form';
        $this->updateMode = false;
        $this->dosage_form_name = null;
        $this->dosage_form_type_id = null;
        $this->resetValidation();
    }

    public function getRecords()
    {
        try {
            return ItemDosageForm::select('item_dosage_forms.*')
            ->when($this->searchDosageFormName, function($q){
                $q->where('dosage_form_name', 'LIKE', "%{$this->searchDosageFormName}%");
            })

            ->when($this->searchDosageFormTypeId, function($q){
                $q->where('dosage_form_type_id',$this->searchDosageFormTypeId);
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
                'dosage_form_name' => 'required',
                'dosage_form_type_id' => 'required',
            ],
        );
        try {
            $validatedData['is_active'] = true;
            ItemDosageForm::create($validatedData);

            $this->dispatch('alert-success','Item Dosage Form created successfully.');

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
        $this->lightBoxTitle = 'Edit Item Dosage Form';
        $this->resetValidation();
        $this->updateMode = true;
        $itemDosageForm = ItemDosageForm::where('id',$id)->first();
        $this->itemDosageForm_id = $id;
        $this->dosage_form_name = $itemDosageForm->dosage_form_name;
        $this->dosage_form_type_id = $itemDosageForm->dosage_form_type_id;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'dosage_form_name' => 'required|min:3|max:100',
            'dosage_form_type_id' => 'required',
        ],[]);

        if ($this->itemDosageForm_id) {
            $itemDosageForm = ItemDosageForm::find($this->itemDosageForm_id);
            $itemDosageForm->update($validatedData);
            $this->updateMode = false;
            $this->dispatch('alert-success','Item Dosage Form Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('hideModal');
            $this->setPage($this->currentPage);
        }
    }

    public function delete($user)
    {
        try {
            ItemDosageForm::find($user)->delete();
            $this->dispatch('alert-success','Sub Category Deleted Successfully');
        } catch (\Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
        }
    }
}