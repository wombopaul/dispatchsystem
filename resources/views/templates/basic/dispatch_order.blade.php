@extends($activeTemplate.'layouts.frontend')

@section('content')
@include($activeTemplate . 'partials.breadcrumb2')
 <div class="wrapper_centering style_2" >
      <div class="container_centering ">
          <div class="container">
              <div class="row justify-content-between">
                  <div class="col-xl-6 col-lg-6 d-flex align-items-center">
                      <div class="main_title_1">
                          <h3><img src="{{getImage('assets/images/diapatchman.png')}}" width="80" height="80" alt=""> Get a Rider</h3>
                          <p>In just few steps and and your consignment is delivered. Ensure to get the weight of your consignment, just incase you dont know the weight u can use our CALCULATOR in the form</p>
                          <p><em>- Delivery Team GnextTech</em></p>
                      </div>
                  </div>
                  <!-- /col -->
                  <div class="col-xl-5 col-lg-5">
                      <div id="wizard_container">
                          <div id="top-wizard">
                             
                          </div>
                          <!-- /top-wizard -->
                          <form id="wrapped" method="POST" autocomplete="on">
                              <input id="website" name="website" type="text" value="">
                              <!-- Leave for security protection, read docs for details -->
                              <div id="middle-wizard">
                                 <!-- /step 1-->
                                    <div class="step">
                                  
                                      <h3 class="main_question" style="font-size:2.5em">Lets get your Request</h3>
                                      <div class="form-group">
                                          <label for="firstname">Enter your Percel</label>
                                          <input type="text" name="firstname" id="firstname" class="form-control required">
                                      </div>
                                     <div class="row">
                                      <div class="col-lg-5 col-md-5 col-5">
                                      <div class="form-group">
                                          <label for="lastname">Enter the Weight (Kg)</label>
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
                                          
                                          <input type='text' name="additional_message" id="from_places" class="form-control" placeholder="Enter pickup location">
                                          <input id="origin" type="hidden" name="origin" required/>
                                      </div>
                                       <div class="form-group">
                                         
                                          <input type='text' name="additional_message" id="to_places" class="form-control" placeholder="Enter  drop off location">
                                          <input id="destination" type="hidden" name="destination" required/>
                                      </div>
                                      
                                  </div>  
                            <!----row------------------------------------------------------------------->
                                   <div class="step">
                                      <div class="review_block" id="result">
                                          <ul >
                                            <li>
                                            <div class="checkbox_radio_container">
                                            <h2 style="color:white">Trip to Delivery: </h2>
                                                  <h5> <label style="color:Yellow">Origin:</label> <span id="from" class="badge badge-primary badge-pill"></span><br>
                                                  <label style="color:Yellow"> To:</label> <span id="to" class="badge badge-primary badge-pill"></span> 
                                                  </h5>
                                                        <label style="color:Yellow">Estimated  Duration without Traffic: <span id="duration_text"></span>
                                                     <div class='row'>
                                                         <div class='col-lg-2'><h2 style="color:Yellow">₦</h2></div>
                                                         <div class='col-lg-6'><h2 style="color:Yellow" id="duration_cost2"></h2>
                                                         <input type='hidden' id="duration_cost">
                                                        </div>
                                                     
                                                    </div>
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
                                  <div class="submit step">
                                  <h2 style="color:white">How Would you like to pay?: </h2>
                                     
                                      <div class="review_block_smiles">
                                        <ul class="clearfix">
                                           <li>
                                                  <div class="container_smile">
                                                 
                                                      <input type="submit" ty id="payOnline" for="good_1" name="question_1" class="radio checkButton" value="Pay Online" >
                                                      
                                                  </div>
                                              </li>
                                        
                                              <li>
                                                  <div class="container_smile">
                                                  <input type="button" id="cash" for="good_1" name="question_1" class="radio checkButton" value="Pay Cash" >
                                                    
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
                               
                                  <!-- /step 5-->

                              </div>
                              <!-- /middle-wizard -->

                              <div id="bottom-wizard">
                                  <button type="button" name="backward" class="backward">Prev</button>
                                  <button type="button" id ="nextPageBtn" name="forward" class="forward" value="Calculate">Next</button>
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
        <h4 class="modal-title"></h4>
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
            <input class='form-control' type="number"style="color:black;"  name="sum" id="sum" placeholder="Weight in Kg" readonly></label>
            </div>
           
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger btnClose" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    


@endsection