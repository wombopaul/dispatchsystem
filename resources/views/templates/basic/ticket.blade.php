@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
    <section class="dashboard-section pt-80">
        <div class="container">
            <div class="pb-80">
                <div class="message__chatbox bg--section">
                    <div class="message__chatbox__header">
                    	<h5 class="title">
	                    	@if($my_ticket->status == 0)
		                        <span class="badge badge--success">@lang('Open')</span>
		                    @elseif($my_ticket->status == 1)
		                        <span class="badge badge--primary">@lang('Answered')</span>
		                    @elseif($my_ticket->status == 2)
		                        <span class="badge badge--warning">@lang('Customer Reply')</span>
		                    @elseif($my_ticket->status == 3)
		                        <span class="badge badge--danger">@lang('Closed')</span>
		                    @endif
                        	@lang('Ticket Id') : <span class="text--base">[#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}</span></h5>
                    </div>
                    <div class="message__chatbox__body">
                    @if($my_ticket->status != 4)
                        <form class="message__chatbox__form row" method="post" action="{{ route('ticket.reply', $my_ticket->id) }}" enctype="multipart/form-data">
                        	@csrf
                        	<input type="hidden" name="replayTicket" value="1">
                            <div class="form--group col-sm-12">
                                <textarea class="form-control form--control" name="message" placeholder="@lang('Enter Message')" required=""></textarea>
                            </div>
                            <div class="form--group col-sm-12">
                                <div class="d-flex">
                                    <div class="left-group col p-0">
                                        <label for="file" class="cmn--label text--title">@lang('Attachments')</label>
                                        <input type="file" class="overflow-hidden form-control form--control mb-2" name="attachments[]" id="file">
                                    </div>
                                       
                                    <div class="add-area">
                                        <label class="cmn--label text--title d-block">&nbsp;</label>
                                        <button class="cmn--btn btn--sm bg--primary form--control ms-2 ms-md-4 addFile" type="button"><i class="las la-plus"></i></button>
                                    </div>
                                </div>

                                <div id="fileUploadsContainer"></div>
                                <span class="info fs--14">@lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')</span>

                            </div>
                            <div class="form--group col-sm-12 mt-2 mb-0">
                                <button type="submit" class="cmn--btn btn--lg">@lang('Send Message')</button>
                            </div>
                        </form>
                    @endif
                    </div>
                </div>
            </div>


            <div class="pb-80">
                <div class="message__chatbox bg--section">
                    <div class="message__chatbox__body">
                        <ul class="reply-message-area">
                            @foreach($messages as $message)
		                        <li>
			                    @if($message->admin_id == 0)
			                            <div class="reply-item">
			                                <div class="name-area">
			                                    <h6 class="title">{{__($message->ticket->name)}}</h6>
			                                </div>
			                                <div class="content-area">
			                                    <span class="meta-date">
			                                        @lang('Posted on') <span class="cl-theme">{{ $message->created_at->format('l, dS F Y @ H:i') }}</span>
			                                    </span>
			                                    <p>
			                                        {{__($message->message)}}
			                                    </p>
			                                     @if($message->attachments()->count() > 0)
			                                        <div class="mt-2">
			                                            @foreach($message->attachments as $k=> $image)
			                                                <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
			                                            @endforeach
			                                        </div>
			                                    @endif
			                                </div>
			                            </div>
			                        @else
			                            <ul>
			                                <li>
			                                    <div class="reply-item">
			                                        <div class="name-area">
			                                            <div class="reply-thumb">
			                                                <img src="{{getImage('assets/admin/images/profile/'. $message->admin->image, '400x400')}}" alt="@lang('Admin Image')">
			                                            </div>
			                                            <h6 class="title">{{__($message->admin->name)}}</h6>
			                                        </div>
			                                        <div class="content-area">
			                                            <span class="meta-date">
			                                                @lang('Posted on'), <span class="cl-theme">{{ $message->created_at->format('l, dS F Y @ H:i') }}</span>
			                                            </span>
			                                            <p>
			                                                {{__($message->message)}}
			                                            </p>
			                                            @if($message->attachments()->count() > 0)
			                                                <div class="mt-2">
			                                                    @foreach($message->attachments as $k=> $image)
			                                                        <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
			                                                    @endforeach
			                                                </div>
			                                            @endif
			                                        </div>
			                                    </div>
			                                </li>
			                            </ul>
			                        </li>
		                        @endif
		                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(
                    `<div class="d-flex removeFile">
                        <div class="left-group col p-0">
                            <label for="file" class="cmn--label text--title">@lang('Attachments')</label>
                            <input type="file" class="overflow-hidden form-control form--control mb-2" name="attachments[]" id="file">
                        </div>
                           
                        <div class="add-area">
                            <label class="cmn--label text--title d-block">&nbsp;</label>
                            <button class="cmn--btn btn--sm bg--danger form--control ms-2 ms-md-4 remove-btn" type="button"><i class="las la-times"></i></button>
                        </div>
                    </div>`
                )
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.removeFile').remove();
            });
        })(jQuery);
    </script>
@endpush