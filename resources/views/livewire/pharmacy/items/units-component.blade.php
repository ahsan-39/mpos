<div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label>Category Group</label>
                <select class="form-control" wire:model.defer="searchCategoryGroupId">
                    <option value="">All</option>
                    @foreach($categoryGroups as $group)
                        <option value="{{$group->id}}">{{$group->category_group_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Unit Name</label>
                <input type="text" placeholder="Unit Name" class="form-control" wire:model.defer="searchName">
            </div>
            <div class="col-md-4 text-md-end">
                <label class="d-sm-block invisible d-none">Invisible Text</label>
                <button type="submit" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="searchFilter">
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
                        <a class="btn btn-success btn_init_modal btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#unitFormModal"><i class="fa fa-plus"></i> Create New Item Unit</a>
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable dtr-inline">
                        <thead class="tbl-head-color">
                            <tr>
                                <th>Sr#</th>
                                <th>Category Group</th>
                                <th>Unit Name</th>
                                <th>Status</th>
                                <th style="width: 15%;">Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->categoryGroup->category_group_name}}</td>
                                <td>{{$row->uom_name}}</td>
                                <td>
                                    <livewire:active-status-component :model="$row" :key="$loop->iteration.time().'status'" />
                                </td>
                                <td>{{date('d/m/Y H:i:s', strtotime($row->created_at))}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#unitFormModal" wire:click="edit({{ $row->id }})" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button>
                                    <a href="javascript:void(0)" wire:click="delete('{{$row->id}}')"  wire:confirm="Are you sure to delete this record ?" class="btn btn-danger btn-xs"><span><i class="fa fa-trash"></i></span></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No result found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-6">
                        Showing {{ $rows->firstItem() }} to {{ $rows->lastItem() }} of total {{$rows->total()}} entries
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end px-2 mx-2 my-2">
                            {{ $rows->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Start-->
<div wire:ignore.self class="modal fade" id="unitFormModal" tabindex="-1" role="dialog" aria-labelledby="unitFormModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$lightBoxTitle}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-4 mb-3">
                        <label>Category Group<span class="req">*</span></label>
                        <div>
                            <select class="form-control @error('category_group_id') is-invalid @enderror" wire:model="category_group_id">
                                <option value="">All</option>
                                @foreach($categoryGroups as $group)
                                    <option value="{{$group->id}}">{{$group->category_group_name}}</option>
                                @endforeach
                            </select>
                            @error('category_group_id')
                            <em class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 mb-3">
                        <label>Unit Name <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control ignoreSpecial @error('uom_name') is-invalid @enderror" wire:model.defer="uom_name" placeholder="" />
                            @error('uom_name')
                            <em class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-4 mb-3">
                        <label>Sub Unit </label>
                        <div>
                            <select class="form-control @error('child_uom_id') is-invalid @enderror" wire:model.defer="child_uom_id">
                                <option value="">Select here</option>
                                @foreach($subUnits as $subUnit)
                                    <option value="{{$subUnit->id}}">{{$subUnit->uom_name}}</option>
                                @endforeach
                            </select>
                            @error('child_uom_id')
                            <em class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 mb-3">
                        <label>Sub Unit Name </label>
                        <div>
                            <input type="text" maxlength="100" class="form-control ignoreSpecial @error('child_uom_value') is-invalid @enderror" wire:model.defer="child_uom_value" placeholder="" />
                            @error('child_uom_value')
                            <em class="error invalid-feedback">{{ $message }}</em>
                            @enderror
                        </div>
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
<!-- Modal End-->

@include('layouts.partials.loading')
</div>
