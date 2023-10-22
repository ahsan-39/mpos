<div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label>Category Group</label>
                <select class="form-control" wire:model.defer="categoryGroupId">
                    <option value="">All</option>
                    @foreach($categoryGroups as $group)
                        <option value="{{$group->id}}">{{$group->category_group_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Category Name</label>
                <input type="text" placeholder="Category Name" class="form-control" wire:model.defer="searchName">
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
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable dtr-inline">
                        <thead class="tbl-head-color">
                            <tr>
                                <th>Sr#</th>
                                <th>Category Group</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th style="width: 30%;">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->categoryGroup->category_group_name}}</td>
                                <td>{{$row->category_name}}</td>
                                <td>
                                    <livewire:active-status-component :model="$row" :key="$loop->iteration.time().'status'" />
                                </td>
                                <td>{{date('d/m/Y H:i:s', strtotime($row->created_at))}}</td>
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

@include('layouts.partials.loading')
</div>
