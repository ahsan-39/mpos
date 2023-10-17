<div>
    <div class="position-relative overflow-hidden">
        @if ($model->isActive())
            <a href="javascript:void(0)" class="nav-link" wire:click="markInActive()" title="Click this button to in-active user">
                <span class="float-right badge bg-green"><i class="fa fa-check"></i> Active</span>
            </a>
        @else
            <a href="javascript:void(0)" class="nav-link" wire:click="markActive()" title="Click this button to active user">
                <span class="float-right badge bg-danger"><i class="fa fa-times"></i> In-Active</span>
            </a>
        @endif
    </div>
    @include('layouts.partials.loading')
</div>