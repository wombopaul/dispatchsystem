<?php $id = uniqid(); ?>
<div class="row" id="{{$id}}">
    <div class="col-lg-6 col-md-6 col-6">
        <div class="form-group">
            <label for="address[receiver_name][]">Receiver full name</label>
            <input type="text" name="address[receiver_name][]" id="address[receiver_name][]" class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-6">
        <div class="form-group">
            <label for="addresses[receiver_phone][]">Receiver phone number</label>
            <input type="tel" name="addresses[receiver_phone][]" id="addresses[receiver_phone][]" class="form-control">
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-12">
        <div class="form-group">
            <input type='text' name="addresses[receiver_address][]" id="to_places" class="form-control destination" placeholder="Enter  drop off location">
            <input id="addresses[receiver_address][]" type="hidden" name="addresses[receiver_address][]" required/>
        </div>
    </div>
    <div class="col-md-2 ml-0 mr-0  pl-0 pr-0">
        <div class="form-group">
            <label class="col-form-label">&nbsp;</label><br>
            <a href="javascript:void(0)" class="text-danger removeCloned" data-removediv="{{ $id }}" title="Remove"><i class="fa fa-times-circle text-danger"></i></a>
        </div>
    </div>
</div>