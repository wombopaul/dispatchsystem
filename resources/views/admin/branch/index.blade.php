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
                                    <th>@lang('Name - Address')</th>
                                    <th>@lang('Email - Phone')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Creations Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($branchs as $branch)
                                <tr>
                                    <td data-label="@lang('Name - Address')">
                                        <span class="font-weight-bold">{{__($branch->name)}}</span><br>
                                        <span>{{$branch->address}}</span>
                                    </td>
                                    <td data-label="@lang('Email - Phone')">
                                        <span class="font-weight-bold">{{$branch->email}}</span><br>
                                        <span>{{$branch->phone}}</span>
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($branch->status == 1)
                                            <span class="badge badge--success">@lang('Open')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Closed')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Creations Date')">
                                         {{ showDateTime($branch->created_at) }} <br> {{ diffForHumans($branch->created_at) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 editBrach"
                                            data-id="{{$branch->id}}"
                                            data-name="{{$branch->name}}"
                                            data-email="{{$branch->email}}"
                                            data-phone="{{$branch->phone}}"
                                            data-address="{{$branch->address}}"
                                            data-status ="{{$branch->status}}"
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
                    {{ paginateLinks($branchs) }}
                </div>
            </div>
        </div>
    </div>


    <div id="branchModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Create New Branch')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.branch.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-control-label font-weight-bold">@lang('Email Address')</label>
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="@lang("Enter Email")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                            <input type="text" class="form-control form-control-lg" name="phone" placeholder="@lang("Enter Phone")"  maxlength="40" required="">
                        </div>


                        <div class="form-group">
                            <label for="address" class="form-control-label font-weight-bold">@lang('Address')</label>
                            <input type="text" class="form-control form-control-lg" name="address" placeholder="@lang("Enter Address")"  maxlength="255" required="">
                        </div>


                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Open')" data-off="@lang('Closed')" name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create Branch')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="updateBranchModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Branch')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.branch.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-control-label font-weight-bold">@lang('Email Address')</label>
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="@lang("Enter Email")"  maxlength="40" required="">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                            <input type="text" class="form-control form-control-lg" name="phone" placeholder="@lang("Enter Phone")"  maxlength="40" required="">
                        </div>


                        <div class="form-group">
                            <label for="address" class="form-control-label font-weight-bold">@lang('Address')</label>
                            <input type="text" class="form-control form-control-lg" name="address" placeholder="@lang("Enter Address")"  maxlength="255" required="">
                        </div>


                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Open')" data-off="@lang('Closed')" name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update Branch')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addNewBrach" ><i class="fa fa-fw fa-paper-plane"></i>@lang('Create New Branch')</a>
@endpush

@push('script')
    <script>
        "use strict";
        $('.addNewBrach').on('click', function() {
            $('#branchModel').modal('show');
        });
        
        $('.editBrach').on('click', function() {
            var modal = $('#updateBranchModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=email]').val($(this).data('email'));
            modal.find('input[name=phone]').val($(this).data('phone'));
            modal.find('input[name=address]').val($(this).data('address'));
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
