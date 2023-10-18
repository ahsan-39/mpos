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
                        <label>Full Name <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control ignoreSpecial @error('name') is-invalid @enderror" wire:model.defer="name" placeholder="Full Name" />
                            @error('name')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Username <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('username') is-invalid @enderror" wire:model.defer="username" placeholder="Username" />
                            @error('username')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Password @if(!$updateMode)<span class="req">*</span>@endif</label>
                        <div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Confirm Password @if(!$updateMode)<span class="req">*</span>@endif</label>
                        <div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="password_confirmation" placeholder="Confirm Password" />
                            @error('password')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Phone <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control ignoreSpecial @error('phone') is-invalid @enderror" wire:model.defer="phone" placeholder="0000000000000" />
                            @error('phone')
                            <em id="phone-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    @if($auth_role_id == 1)
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label>Role @if(!$updateMode)<span class="req">*</span>@endif</label>
                        <div class="form-group">
                            <select id="role" class="form-control @error('role_id') is-invalid @enderror" wire:model="role_id">
                                <option value="">Select Role</option>
                                @foreach($rolesList as $role)
                                <option value="{{$role->id}}">{{ Illuminate\Support\Str::title(str_replace('-',' ',$role->name))}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <em id="name-error" class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" wire:click.prevent="cancel()" wire:loading.attr="disabled" data-dismiss="modal">Close</button>
                @if($updateMode)
                <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="update()">Update</button>
                @else
                <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="save" wire:loading.attr="disabled">Save</button>
                <div wire:loading wire:target="save">
                    <button class="btn btn-sm btn-primary" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>