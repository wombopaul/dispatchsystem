@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Unit')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Last Update')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($types as $type)
                                <tr>
                                    <td data-label="@lang('Name')">
                                        <span class="font-weight-bold">{{__($type->name)}}</span>
                                    </td>

                                    <td data-label="@lang('Unit')">
                                        <span>{{__($type->unit->name)}}</span>
                                    </td>

                                    <td data-label="@lang('Price')">
                                        <span>{{getAmount($type->price)}} {{__($general->cur_text)}}</span>
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($type->status == 1)
                                            <span class="badge badge--success">@lang('Enable')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Disable')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Last Update')">
                                        {{ showDateTime($type->updated_at) }} <br> {{ diffForHumans($type->updated_at) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateUnit"
                                            data-id="{{$type->id}}"
                                            data-name="{{$type->name}}"
                                            data-price="{{getAmount($type->price)}}"
                                            data-unit="{{$type->unit_id}}"
                                            data-status ="{{$type->status}}"
                                        ><i class="las la-edit"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($types) }}
                </div>
            </div>
        </div>
    </div>


    <div id="unitModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Courier Type')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.unit.type.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="unit" class="form-control-label font-weight-bold">@lang('Select Unit')</label>
                            <select class="form-control form-control-lg" name="unit" id="unit" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{__($unit->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-control-label font-weight-bold">@lang('Price')</label>
                            <div class="input-group mb-3">
                                  <input type="text" id="price" class="form-control form-control-lg" placeholder="@lang('Enter Price')" name="price" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                                  </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create Type')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="updateUnitModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Courier Type')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.unit.type.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="unit" class="form-control-label font-weight-bold">@lang('Select Unit')</label>
                            <select class="form-control form-control-lg" name="unit" id="unit" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{__($unit->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-control-label font-weight-bold">@lang('Price')</label>
                            <div class="input-group mb-3">
                                  <input type="text" id="price" class="form-control form-control-lg" placeholder="@lang('Enter Price')" name="price" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                                  </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update Type')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addUnit" ><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Type')</a>
@endpush

@push('script')
<script>
    "use strict";
    $('.addUnit').on('click', function() {
        $('#unitModel').modal('show');
    });
    
    $('.updateUnit').on('click', function() {
        var modal = $('#updateUnitModel');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=name]').val($(this).data('name'));
        modal.find('input[name=price]').val($(this).data('price'));
        modal.find('select[name=unit]').val($(this).data('unit'));
        var data = $(this).data('status');
        if(data == 1){
            modal.find('input[name=status]').bootstrapToggle('on');
        }else{
            modal.find('input[name=status]').bootstrapToggle('off');
        }
        modal.modal('show');
    });
</script>
@endpush
