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
                                    <th>@lang('Manager')</th>
                                    <th>@lang('Email - Phone')</th>
                                    <th>@lang('Joined At')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($branchManagers as $manager)
                                <tr>
                                    <td data-label="@lang('Branch')">
                                        <span class="font-weight-bold">{{__($manager->branch->name)}}</span>
                                    </td>

                                    <td data-label="@lang('Manager')">
                                        <span class="font-weight-bold">{{$manager->fullname}}</span>
                                        <br>
                                        <span class="small">
                                            <a href="{{ route('admin.branch.manager.edit', $manager->id) }}"><span>@</span>{{ $manager->username }}</a>
                                        </span>
                                    </td>

                                    <td data-label="@lang('Email - Phone')">
                                        <span>{{$manager->email}}<br>{{ $manager->mobile }}</span>
                                    </td>

                                    <td data-label="@lang('Joined At')">
                                        {{ showDateTime($manager->created_at) }} <br> {{ diffForHumans($manager->created_at) }}
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($manager->status == 1)
                                            <span class="badge badge--success">@lang('Active')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Banned')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{route('admin.branch.manager.edit', $manager->id)}}" class="icon-btn btn--primary ml-1">@lang('Edit')</a>
                                        <a href="{{route('admin.branch.manager.staff.list', $manager->branch_id)}}" class="icon-btn btn--info ml-1">@lang('Staff List')</a>
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
                    {{ paginateLinks($branchManagers) }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.branch.manager.create')}}" class="btn btn-sm btn--primary box--shadow1 text--small addNewBrach" ><i class="fa fa-fw fa-paper-plane"></i>@lang('Add New Manager')</a>
@endpush
