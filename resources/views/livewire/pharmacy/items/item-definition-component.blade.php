<div>

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
                        <a class="btn btn-success btn_init_modal btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#supplierFormModal"><i class="fa fa-plus"></i> Add Item Definition</a>
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable dtr-inline">
                        <thead class="tbl-head-color">
                            <tr>
                                <th>Sr#</th>
                                <th>Category Group</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Item ID</th>
                                <th>Item/Medicine/Disposable</th>
                                <th>Route</th>
                                <th style="width: 15%;">Created Date</th>
                                <th>Expiry</th>
                                <th>Action</th>
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

<!-- Modal Start-->
<div wire:ignore.self class="modal fade" id="supplierFormModal" tabindex="-1" role="dialog" aria-labelledby="supplierFormModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Category Group<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select Category</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Category<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Sub Category<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Item Type<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Generic<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Dosage Form<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Dosage Route<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Strength<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select here</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label>Unit Of Measure<span class="req">*</span></label>
                        <select class="form-control"  >
                            <option value="">Select Category</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                    <label>Pack Size</label>
                        <div>
                            <input type="text" maxlength="100" class="form-control"  placeholder="000" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                    <label>Unit Pack Size</label>
                        <div>
                            <input type="text" maxlength="100" class="form-control"  placeholder="000" />
                        </div>
                    </div>
                    <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Expiry</label>
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
