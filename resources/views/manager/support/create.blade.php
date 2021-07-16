@extends('manager.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body">
                    <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">@lang('Name')</label>
                                <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control form-control-lg" placeholder="@lang('Enter your name')" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">@lang('Email address')</label>
                                <input type="email"  name="email" value="{{@$user->email}}" class="form-control form-control-lg" placeholder="@lang('Enter your email')" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="website">@lang('Subject')</label>
                                <input type="text" name="subject" value="{{old('subject')}}" class="form-control form-control-lg" placeholder="@lang('Subject')" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="priority">@lang('Priority')</label>
                                <select name="priority" class="form-control form-control-lg" required="">
                                    <option value="3">@lang('High')</option>
                                    <option value="2">@lang('Medium')</option>
                                    <option value="1">@lang('Low')</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="inputMessage">@lang('Message')</label>
                                <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg" placeholder="@lang('Enter Message')" required="">{{old('message')}}</textarea>
                            </div>
                        </div>


                       <div class="col-md-12">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="inputAttachments">@lang('Attachments')</label>
                                </div>
                                <div class="col-9 ">
                                    <div class="file-upload-wrapper" data-text="@lang('Select your file!')">
                                        <input type="file" name="attachments[]" id="inputAttachments"
                                        class="file-upload-field"/>
                                    </div>
                                    <div id="fileUploadsContainer"></div>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn--dark extraTicketAttachment"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-12 ticket-attachments-message text-muted mt-3">
                                    @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block" id="recaptcha"><i class="fa fa-fw fa-paper-plane"></i> @lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            })
            $('.extraTicketAttachment').on('click',function(){
                $("#fileUploadsContainer").append(`
                <div class="file-upload-wrapper" data-text="@lang('Select your file!')"><input type="file" name="attachments[]" id="inputAttachments" class="file-upload-field"/></div>`)
            });
        })(jQuery);
    </script>
@endpush

