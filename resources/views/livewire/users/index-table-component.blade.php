<div>
    @include('livewire.users.form-component')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label>Name</label>
                    <input type="text" placeholder="Name" class="form-control" wire:model.defer="searchName">
                </div>
                {{-- <div class="col-md-3">
                    <label>Phone</label>
                    <input type="text" placeholder="0000000000000" class="form-control" wire:model.defer="searchPhone">
                </div> --}}
                <div class="col-md-3">
                    <label>Username</label>
                    <input type="text" placeholder="Username" class="form-control" wire:model.defer="searchUsername">
                </div>
                <div class="col-md-3">
                    <label>Role</label>
                    <select class="form-control" wire:model.defer="searchRole">
                        <option value="">Select Role</option>
                        @foreach($rolesList as $role)
                        <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 text-md-end">
                    <label class="d-sm-block invisible d-none">Invisible Text</label>
                    <button type="submit" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="searchUser">
                        <i class="fa fa-search"></i>
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset" wire:click="clearSearch">
                        <i class="fa fa-sync"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="dataTables_length" style="margin-bottom: 10px;">
                        <span>Show</span>
                        <label>
                            <select wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                        <span>entries</span>
                        <h5 class="border-bottom" style="float:right">
                            <a class="btn btn-success btn_init_modal btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#userFormModal"><i class="fa fa-plus"></i> Create New User</a>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable dtr-inline">
                            <thead class="tbl-head-color">
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th style="width: 15%;">Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->role_id?$user->role->name:'N/A'}}</td>
                                    <td>{{date('d/m/Y H:i:s', strtotime($user->created_at))}}</td>
                                    <td>
                                        <livewire:active-status-component :model="$user" :key="$loop->iteration.time().'status'" />
                                    </td>
                                    @if($user->id != 1)
                                    <td>
                                        <button data-toggle="modal" data-target="#userFormModal" wire:click="edit({{ $user->id }})" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button>
                                        <a href="javascript:void(0)" wire:click="$dispatch('confirmDelete','{{$user->id}}')" class="btn btn-danger btn-xs"><span><i class="fa fa-trash"></i></span></a>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No result found
                                    </td>
                                </tr>
                                @endforelse
                        </table>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-6">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of total {{$users->total()}} entries
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end px-2 mx-2 my-2">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.loading')
</div>