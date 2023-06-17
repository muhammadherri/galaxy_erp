<form action="{{ route("admin.paymentreport.index") }}" method="GET" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    <div class="modal fade" id="bsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Balance Sheet</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period</label>
                                    <input required type="number" class="form-control" name="period" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Template</label>
                                    <input type="number" class="form-control" name="voucher_to" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
