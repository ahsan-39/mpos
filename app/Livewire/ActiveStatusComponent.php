<?php

namespace App\Livewire;

use Livewire\Component;
use App\Contracts\ActiveStatus;
use Illuminate\Support\Facades\Auth;

class ActiveStatusComponent extends Component
{
    public $model;
    public $auth_role_id;

    public function mount($model)
    {
        $this->model = $model;
        $this->auth_role_id = Auth::user()->role_id;
    }

    public function render()
    {
        if ( !$this->model instanceof  ActiveStatus){
            return '<div></div>';
        }

        return view('livewire.active-status-component');
    }

    public function markActive()
    {
        $this->model->markActive(true);
        $this->emit('alert-success','Account status is updated.');
    }

    public function markInActive()
    {
        $this->model->markActive(false);
        $this->emit('alert-success','Account status is updated.');
    }
}
