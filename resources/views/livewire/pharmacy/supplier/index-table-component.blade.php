<div>
@include('livewire.pharmacy.supplier.form-component')

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
                            <a class="btn btn-success btn_init_modal btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#userFormModal"><i class="fa fa-plus"></i> Create New Supplier</a>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable dtr-inline">
                            <thead class="tbl-head-color">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th style="width: 15%;">Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            </div>
</div>
</div>
@include('layouts.partials.loading')
</div>
