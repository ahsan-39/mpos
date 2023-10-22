<div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label>Item Strength Name</label>
                <input type="text" placeholder="Item Strength Name" class="form-control" wire:model.defer="searchStrengthName">
            </div>
            <div class="col-md-3 text-md-end">
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
                        <a class="btn btn-success btn_init_modal btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#itemStrengthModal"><i class="fa fa-plus"></i> Create Item Strength</a>
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable dtr-inline">
                        <thead class="tbl-head-color">
                            <tr>
                                <th>Sr#</th>
                                <th>Item Strength Name</th>
                                <th>Status</th>
                                <th style="width: 15%;">Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->strength_name}}</td>
                                <td>
                                    <livewire:active-status-component :model="$row" :key="$loop->iteration.time().'status'" />
                                </td>
                                <td>{{date('d/m/Y H:i:s', strtotime($row->created_at))}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#itemStrengthModal" wire:click="edit({{ $row->id }})" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button>
                                    <a href="javascript:void(0)" wire:click="delete('{{$row->id}}')"  wire:confirm="Are you sure to delete this record ?" class="btn btn-danger btn-xs"><span><i class="fa fa-trash"></i></span></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    No result found
                                </td>
                            </tr>
                            @endforelse
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
<div wire:ignore.self class="modal fade" id="itemStrengthModal" tabindex="-1" role="dialog" aria-labelledby="supplierFormModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label>Item Strength Name <span class="req">*</span></label>
                        <div>
                            <input type="text" maxlength="100" class="form-control @error('strength_name') is-invalid @enderror" wire:model.defer="strength_name" placeholder="Item Strength Name" />
                            @error('strength_name')
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
</div>
<!-- Modal End-->
@include('layouts.partials.loading')
</div>