<div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label>Transaction Date</label>
                <input type="date" placeholder="Unit Name" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Generic/Item Name</label>
                <select class="form-control">
                    <option value="">All</option>
                </select>
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
                                <th>Transaction</th>
                                <th>Generic/Item Name</th>
                                <th>Available Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>  
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.loading')
</div>
