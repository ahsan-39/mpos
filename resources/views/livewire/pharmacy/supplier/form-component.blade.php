<!-- Modal -->
<div wire:ignore.self class="modal fade" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$lightBoxTitle}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 {{-- @if($errors->any())
                    {{ implode('', $errors->all('<p>:message</p>')) }}
                    @endif --}}
                <div class="row">
                <div class="col-md-6 col-sm-6 mb-3">
                <label>Code <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('code') is-invalid @enderror" wire:model.defer="username" placeholder="0000000" />
                            @error('code')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Name <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('name') is-invalid @enderror" wire:model.defer="username" placeholder="Name" />
                            @error('name')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                    <label>Phone <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control ignoreSpecial @error('phone') is-invalid @enderror" wire:model.defer="name" placeholder="000000000" />
                            @error('phone')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Email <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('email') is-invalid @enderror" wire:model.defer="username" placeholder="Email" />
                            @error('email')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                        <label>Address <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('address') is-invalid @enderror" wire:model.defer="username" placeholder="Address" />
                            @error('address')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" wire:click.prevent="cancel()" wire:loading.attr="disabled" data-dismiss="modal">Close</button>
                @if($updateMode)
                <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="update()">Update</button>
                @else
                <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="save" wire:loading.attr="disabled">Save</button>
                <div wire:loading wire:target="save">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>