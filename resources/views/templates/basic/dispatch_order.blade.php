@extends($activeTemplate.'layouts.frontend')

@section('content')
@include($activeTemplate . 'partials.breadcrumb2')
 <div class="wrapper_centering style_2">
      <div class="container_centering ">
          <div class="container">
              <div class="row justify-content-between">
                  <div class="col-xl-6 col-lg-6 d-flex align-items-center">
                      <div class="main_title_1">
                          <h3><img src="{{getImage('assets/images/diapatchman.png')}}" width="80" height="80" alt=""> Get a Rider</h3>
                          <p>In just few steps and and your consignment id delivered. Ensure to get the weight of your consignment, just incase you dont know the weight u can use our CALCULATOR in the form</p>
                          <p><em>- Delivery Team GnextTech</em></p>
                      </div>
                  </div>
                  <!-- /col -->
                  <div class="col-xl-5 col-lg-5">
                      <div id="wizard_container">
                          <div id="top-wizard">
                             
                          </div>
                          <!-- /top-wizard -->
                          <form id="wrapped" method="POST" autocomplete="off">
                              <input id="website" name="website" type="text" value="">
                              <!-- Leave for security protection, read docs for details -->
                              <div id="middle-wizard">
                                 <!-- /step 1-->
                                  <div class="step">
                                      <h3 class="main_question" style="font-size:2.5em">What will you like to send today?</h3>
                                      <div class="form-group">
                                          <label for="firstname">Enter your Percel</label>
                                          <input type="text" name="firstname" id="firstname" class="form-control required">
                                      </div>
                                     <div class="row">
                                      <div class="col-lg-5 col-md-5 col-5">
                                      <div class="form-group">
                                          <label for="lastname">Enter the Weight</label>
                                          <input type="text" name="lastname" id="lastname" class="form-control required">
                                      </div>
                                    </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                        <label>I dont know the weight:</label>
                                      </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                        <button class="btn btn-primary" id="change">Cal. Weight</button>
                                    </div>
                                    </div>
                                  </div>
                                      <div class="form-group">
                                          <label for="email">Your Email</label>
                                          <input type="email" name="email" id="email" class="form-control required ">
                                      </div>
                                      <div class="form-group">
                                          <label for="telephone">Telephone</label>
                                          <input type="text" name="telephone" id="telephone" class="form-control">
                                      </div>
                                       <div class="form-group">
                                          <label for="additional_message_label">Drop off Address</label>
                                          <input type='text' name="additional_message" id="autocomplete" class="form-control" >
                                      </div>
                                     
                                  </div> 
                                  <!-- /row------------------------------------------------------------------- --> 
                                  <div class="step">
                                      <h3 class="main_question"><strong>3 of 5</strong>Cost of Trip</h3>
                                      <div class="review_block">
                                          <ul>
                                            <li>
                                                  <div class="checkbox_radio_container">
                                                     <h3 style="color:white">This trip will cost you: </h3>
                                                     <h1 style="color:Yellow">N5000.00</h1>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_1" name="question_3[]" class="required" value="Google and Search Engines" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_1"></label>
                                                      <label for="question_3_opt_1" class="wrapper">Am fine with this</label>
                                                  </div>
                                              </li>
                                             
                                          </ul>
                                          <small><em>Price is calculated by the weight of your cargo and distance entered *</em></small>
                                      </div>
                                  </div>
                                  <!-- /step 3-->
                                  
                                  <!-- /step 2-->
                                  <div class="step">
                                      <h3 class="main_question"><strong>3 of 5</strong>How Would you like to pay?</h3>
                                      <div class="review_block_smiles">
                                        <ul class="clearfix">
                                           <li>
                                                  <div class="container_smile">
                                                      <input type="radio" id="good_1" name="question_1" class="required" value="Good" onchange="getVals(this, 'question_1');">
                                                      <label class="radio smile_4" for="good_1"><span>Good</span></label>
                                                  </div>
                                              </li>
                                        
                                              <li>
                                                  <div class="container_smile">
                                                      <input type="radio" id="very_good_1" name="question_1" class="required" value="Very Good" onchange="getVals(this, 'question_1');">
                                                      <label class="radio smile_5" for="very_good_1"><span>Very Good</span></label>
                                                  </div>
                                              </li>
                                        </ul>
                                        <div class="row justify-content-between add_bottom_25">
                                          <div class="col-4">
                                            <em>E-payment online</em>
                                          </div>
                                          <div class="col-4 text-right">
                                            <em>At office or Driver arrival</em>
                                          </div>
                                        </div>
                                      </div>
                                      
                                  </div>
                                 

                                  <div class="step">
                                      <h3 class="main_question"><strong>3 of 5</strong>How did you hear about us?</h3>
                                      <div class="review_block">
                                          <ul>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_1" name="question_3[]" class="required" value="Google and Search Engines" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_1"></label>
                                                      <label for="question_3_opt_1" class="wrapper">Google and Search Engines</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_2" name="question_3[]" class="required" value="Emails or Newsletter" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_2"></label>
                                                      <label for="question_3_opt_2" class="wrapper">Emails or Newsletter</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_3" name="question_3[]" class="required" value="Friends or other people" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_3"></label>
                                                      <label for="question_3_opt_3" class="wrapper">Friends or other people</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_4" name="question_3[]" class="required" value="Print Advertising" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_4"></label>
                                                      <label for="question_3_opt_4" class="wrapper">Print Advertising</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="checkbox" id="question_3_opt_5" name="question_3[]" class="required" value="Print Advertising" onchange="getVals(this, 'question_3');">
                                                      <label class="checkbox" for="question_3_opt_5"></label>
                                                      <label for="question_3_opt_5" class="wrapper">Other</label>
                                                  </div>
                                              </li>
                                          </ul>
                                          <small><em>Multiple selections *</em></small>
                                      </div>
                                  </div>
                                  <!-- /step 3-->

                                  <div class="step">
                                      <h3 class="main_question"><strong>4 of 5</strong>Summary</h3>
                                      <div class="summary">
                                          <ul>
                                              <li>
                                                  <strong>1</strong>
                                                  <h5>How was the service provided?</h5>
                                                  <p id="question_1" class="mb-2"></p>
                                                  <p id="additional_message"></p>
                                              </li>
                                              <li>
                                                  <strong>2</strong>
                                                  <h5>Would you reccomend our company?</h5>
                                                  <p id="question_2" class="mb-2"></p>
                                                  <p id="additional_message_2"></p>
                                              </li>
                                              <li>
                                                  <strong>3</strong>
                                                  <h5>How did you hear about our company?</h5>
                                                  <p id="question_3"></p>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <!-- /step 4-->

                                   <div class="submit  step">
                                      <h3 class="main_question mb-4"><strong>2 of 5</strong>Would you reccomend our company?</h3>
                                      <div class="review_block">
                                          <ul>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="radio" id="no" name="question_2" class="required" value="No" onchange="getVals(this, 'question_2');">
                                                      <label class="radio" for="no"></label>
                                                      <label for="no" class="wrapper">No</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="radio" id="maybe" name="question_2" class="required" value="Maybe" onchange="getVals(this, 'question_2');">
                                                      <label class="radio" for="maybe"></label>
                                                      <label for="maybe" class="wrapper">Maybe</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="radio" id="probably" name="question_2" class="required" value="Probably" onchange="getVals(this, 'question_2');">
                                                      <label class="radio" for="probably"></label>
                                                      <label for="probably" class="wrapper">Probably</label>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="checkbox_radio_container">
                                                      <input type="radio" id="sure" name="question_2" class="required" value="Sure" onchange="getVals(this, 'question_2');">
                                                      <label class="radio" for="sure"></label>
                                                      <label for="sure" class="wrapper">100% Sure</label>
                                                  </div>
                                              </li>
                                          </ul>
                                      </div>
                                      <!-- /review_block-->
                                      <div class="form-group">
                                          <label for="additional_message_2_label">Additional message</label>
                                          <textarea name="additional_message_2" id="additional_message_2_label" class="form-control" style="height:120px;" onkeyup="getVals(this, 'additional_message_2');"></textarea>
                                      </div>
                                  </div>

                                  <!-- /step 5-->

                              </div>
                              <!-- /middle-wizard -->

                              <div id="bottom-wizard">
                                  <button type="button" name="backward" class="backward">Prev</button>
                                  <button type="button" name="forward" class="forward">Next</button>
                                  <button type="submit" name="process" class="submit">Submit</button>
                              </div>
                              <!-- /bottom-wizard -->

                          </form>
                      </div>
                      <!-- /Wizard container -->
                  </div>
                  <!-- /col -->
              </div>
          </div>
          <!-- /row -->
      </div>
</div>
  <!-------- Modal Start --->
  <div class="modal fade" tabindex="10" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">dfdddfd</h4>
      </div>
      <div class="modal-body">
          <p style="font-size:11px; color:red; line-height:20px;">Kindly use a tape to measure your percel as shown in the diagram and enter to get the weight of your percel</p>
        <div class="row">
            <div class="col-lg-4 m-0">
                <input class='form-control m-0' type="number" name="value1" id="value1"  placeholder="Width">
            </div> <label>x</label>
            <div class="col-sm-4 m-0">
                <input class='form-control' type="number" name="value2" id="value2"  placeholder="height">
            </div> <label>x</label>
            <div class="col-sm-4 m-0">
                <input class='form-control' type="number" name="value3" id="value3" placeholder="breath">
            </div> =
            <div class="col-sm-6">
                <input class='form-control' type="number" name="sum" id="sum" placeholder="Weight">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btnClose" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    


@endsection