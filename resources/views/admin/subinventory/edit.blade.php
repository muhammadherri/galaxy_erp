@extends('layouts.admin')

@section('content')
<form action="{{ route("admin.subInventory.update", [$sub->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @csrf
    <div class="bs-stepper wizard-modern modern-wizard-example">
        <div class="bs-stepper-content">
            <div class="card-header mb-50">
                <h6 class="card-title">
                    <a href="{{ route("admin.subInventory.index") }}" class="breadcrumbs__item">Sub Inventory List </a>
                    <a href="" class="breadcrumbs__item">{{ trans('cruds.purchaseOrder.fields.edit') }} </a>
                </h6>
            </div>
            <hr>
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ trans('cruds.subInventory.fields.sub_inventory_name') }}</label>
                    <input type="text" name="sub_inventory_name" value="{{$sub ->sub_inventory_name}}" class="form-control" readonly required />
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ trans('cruds.subInventory.fields.description') }}</label>
                    <input type="text" name="description" value="{{$sub ->description}}" class="form-control" required />
                </div>
            </div>
            <div class="row mb-2">
                <div class="mb-1 col-md-4">
                    <label class="form-label">{{ trans('cruds.subInventory.fields.locator_type') }}</label>
                    <input type="text" name="locator_type" value="{{$sub ->locator_type}}" class="form-control" required />
                </div>
                <div class="mb-1 col-md-4">
                    <label class="form-label">{{ trans('cruds.subInventory.fields.attribute_category') }}</label>
                    <input type="text" name="attribute_category" value="{{$sub ->attribute_category}}" class="form-control" required />
                </div>
                <div class="mb-1 col-md-4">
                    <label class="form-label">{{ trans('cruds.subInventory.fields.sub_inventory_group') }}</label>
                    <input type="text" name="sub_inventory_group" value="{{$sub ->sub_inventory_group}}" class="form-control" required />
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-warning"><i data-feather='save'></i> Reset</button>
                <button class="btn btn-success"><i data-feather='save'></i> {{ trans('global.save') }}</button>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection
