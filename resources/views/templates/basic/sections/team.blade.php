@php
    $team = getContent('team.content', true);
   $teams = getContent('team.element', false, 8, false);
@endphp
<section class="team-section pt-60 pb-120">
    <div class="container">
        <div class="section__header section__header__center">
            <span class="section__cate">
                {{__(@$team->data_values->title)}}
            </span>
            <h3 class="section__title">{{__($team->data_values->heading)}}</h3>
            <p>
               {{__(@$team->data_values->sub_heading)}}
            </p>
        </div>
        <div class="row g-4 justify-content-center">

            @foreach($teams as $value)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="team__item">
                        <div class="team__item-thumb">
                            <img src="{{getImage('assets/images/frontend/team/'. $value->data_values->member, '600x600')}}" alt="@lang('team')">
                            <a href="{{getImage('assets/images/frontend/team/'. $value->data_values->member, '600x600')}}" class="view-img" data-lightbox><i class="las la-plus"></i></a>
                        </div>
                        <div class="team__item-content">
                            <h5 class="team__item-title">{{__($value->data_values->name)}}</h5>
                            <span class="text--base">{{__($value->data_values->designation)}}</span>
                            <span class="d-block">@lang('Complete Delivery') : <span class="text--base">{{__($value->data_values->total_delivery)}}</span></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


