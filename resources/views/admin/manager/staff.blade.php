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
                                    <th>@lang('Branch')</th>
                                    <th>@lang('Staff')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Joined At')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($staffs as $staff)
                                <tr>
                                    <td data-label="@lang('Branch')">
                                        <span class="font-weight-bold">{{__($staff->branch->name)}}</span>
                                    </td>

                                    <td data-label="@lang('Staff')">
                                        <span class="font-weight-bold">{{$staff->fullname}}</span>
                                        <br>
                                        <span class="small">
                                            <span>@</span>{{ $staff->username }}
                                        </span>
                                    </td>

                                    <td data-label="@lang('Email')">
                                        <span class="font-weight-bold">{{$staff->email}}<br>{{ $staff->mobile }}</span>
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
                    {{ paginateLinks($staffs) }}
                </div>
            </div>
        </div>
    </div>
@endsection
