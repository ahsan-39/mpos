<?php

namespace App\Livewire\Pharmacy\Items;

use App\Models\Pharmacy\ItemDefinition;
use Livewire\Component;
use Livewire\WithPagination;

class ItemDefinitionComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage;
    public $lightBoxTitle = 'Add Sub Category';
    public $hideRole = '';
    public $perPage=10;
    public $search=false;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.pharmacy.items.item-definition-component');
    }
}
