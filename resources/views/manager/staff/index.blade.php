@extends('manager.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Branch')</th>
                                <th>@lang('Staff')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Joined At')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($staffs as $staff)
                            <tr>
                                <td data-label="@lang('Branch')">
                                    <span class="font-weight-bold">{{__($staff->branch->name)}}</span>
                                </td>

                                <td data-label="@lang('Staff')">
                                    <span>{{__($staff->fullname)}}</span>
                                    <br>
                                    <a href="{{route('manager.staff.edit', encrypt($staff->id))}}">
                                        <span>@</span>{{__($staff->username)}}
                                    </a>
                                </td>

                                <td data-label="@lang('Email')">
                                    <span>{{__($staff->email)}}<br>{{__($staff->mobile)}}</span>
                                </td>

                                 <td data-label="@lang('Joined At')">
                                    {{ showDateTime($staff->created_at) }} <br> {{ diffForHumans($staff->created_at) }}
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($staff->status == 1)
                                        <span class="badge badge--success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge--danger">@lang('Banned')</span>
                                    @endif
                                </td>
                              
                                <td data-label="@lang('Action')">
                                    <a href="{{route('manager.staff.edit', encrypt($staff->id))}}" class="icon-btn btn--primary ml-1"><i class="las la-edit"></i></a>
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
                {{paginateLinks($staffs)}}
            </div>
        </div>
    </div>
</div>
@endsection


@push('breadcrumb-plugins')
<form action="{{route('manager.staff.search')}}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
    <div class="input-group has_append  ">
        <input type="text" name="search" class="form-control" placeholder="@lang('Username / Email')" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@endpush
