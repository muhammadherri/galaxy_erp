@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.min.js')}}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{ route("admin.materialTrnTypes.index") }}" class="breadcrumbs__item">Settings</a>
    <a href="{{ route("admin.materialTrnTypes.index") }}" class="breadcrumbs__item">Material Transaction Types</a>
    <a href="" class="breadcrumbs__item active">Edit</a>
@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="{{ route("admin.materialTrnTypes.update",[$mtrl->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                    <button type="button" class="step-trigger">
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Add Material Transaction Type</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ trans('cruds.materialTrnTypes.fields.trx_code') }}</label>
                            <input type="text" name="trx_code" value="{{$mtrl->trx_code}}" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ trans('cruds.materialTrnTypes.fields.trx_type') }}</label>
                            <input type="text" name="trx_types" value="{{$mtrl->trx_types}}" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ trans('cruds.materialTrnTypes.fields.trx_action') }}</label>
                            <input type="text" name="trx_actions" value="{{$mtrl->trx_actions}}" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ trans('cruds.materialTrnTypes.fields.trx_source_types') }}</label>
                            <input type="text" name="trx_source_types" value="{{$mtrl->trx_source_types}}" class="form-control" required/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
