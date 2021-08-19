<?php $id = uniqid(); ?>
<div class="row" id="{{$id}}">
    <div class="col-lg-6 col-md-6 col-6">
        <div class="form-group">
            <label for="{{"receiver_name_" . $id }}">Receiver full name</label>
            <input type="text" name="address[receiver_name][]" id="{{"receiver_name_" . $id }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-6">
        <div class="form-group">
            <label for="{{ "receiver_phone_" . $id }}">Receiver phone number</label>
            <input type="tel" name="addresses[receiver_phone][]" id="{{ "receiver_phone_" . $id }}" class="form-control">
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-12">
        <div class="form-group">
            <label for="{{ 'to_' . $id }}">Drop off location</label>
            <input type='text' name="addresses[receiver_address][]" id="{{ 'to_' . $id }}" class="form-control">
            <input id="{{ 'to_hidden_' . $id }}" type="hidden" name="addresses[receiver_address][]" required/>
        </div>
    </div>
    <div class="col-md-2 mt-2">
        <div class="form-group">
            <label class="col-form-label">&nbsp;</label><br>
            <a href="javascript:void(0)" class="text-danger removeCloned" data-removediv="{{ $id }}" title="Remove"><i class="fa fa-times-circle text-danger"></i></a>
        </div>
    </div>
</div>

<script>
    $(function() {
        var input = document.getElementById('to_' + '{{ $id }}');
        var hiddenId = 'to_hidden_' + '{{ $id }}';
        var to = new google.maps.places.Autocomplete(input);
        
        google.maps.event.addListener(to, 'place_changed', function () {
            var to_formatted = to.getPlace().formatted_address;            
            $('#' + hiddenId).val(to_formatted);
        });

    })
</script>