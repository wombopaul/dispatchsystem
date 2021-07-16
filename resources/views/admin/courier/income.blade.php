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
                                    <th>@lang('Date')</th>
                                    <th>@lang('Income')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($branchIncomes as $branchIncome)
                                <tr>
                                    <td data-label="@lang('Branch')">
                                        <span>{{__($branchIncome->brach->name)}}</span>
                                    </td>

                                    <td data-label="@lang('Date')">
                                        <span>{{showDateTime($branchIncome->date, 'd M Y')}}</span>
                                    </td>

                                    <td data-label="@lang('Amount')">
                                        <span>{{getAmount($branchIncome->totalAmount)}} {{$general->cur_text}}</span>
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
                    {{ paginateLinks($branchIncomes) }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <form action="{{route('admin.branch.income.date.search')}}" method="GET" class="form-inline float-sm-right">

         <div class="input-group has_append bg--white">
            <select class="form-control" name="branch_id" required="">
                <option value="">----@lang('Select Branch')----</option>
                @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{__($branch->name)}}</option>
                @endforeach
           </select>
        </div>

        <div class="input-group has_append bg--white ml-2">
            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='bottom right' placeholder="@lang('Min date - Max date')" autocomplete="off" value="{{ @$dateSearch }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush


@push('script-lib')
  <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
  <script>
    (function($){
        "use strict";
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
  </script>
@endpush

