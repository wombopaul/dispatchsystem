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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Phone')</th>
                                    <th>@lang('Address')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($branchs as $branch)
                                <tr>
                                    <td data-label="@lang('Name')">
                                        <span>{{__($branch->name)}}</span>
                                    </td>
                                    <td data-label="@lang('Email')">
                                        <span>{{__($branch->email)}}</span>
                                    </td>
                                     <td data-label="@lang('Phone')">
                                        <span>{{__($branch->phone)}}</span>
                                    </td>

                                    <td data-label="@lang('Address')">
                                        <span>{{__($branch->address)}}</span>
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
                    {{paginateLinks($branchs)}}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
<form action="{{route('manager.branch.search')}}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
    <div class="input-group has_append  ">
        <input type="text" name="search" class="form-control" placeholder="@lang('Name / Email / Address')" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@endpush