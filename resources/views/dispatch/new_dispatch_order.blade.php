@extends('dispatch.layouts.app')
@section('content')
<div class="page-content">
    <div class="wizard-v6-content">
   <div class="wizard-form">
		        <form class="form-register"  action="#" method="post">
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<p class="step-icon"><span>1</span></p>
			            	<span class="step-text">Personal Info</span>
			            </h2>
                       
			            <section class="d-none">
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3>Personal Info</h3>
			                		<span>1/4</span>
			                	</div>

                                
                                <div class="form-row2">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="address" name="address" required placaholder="Enter a phone number to Proceed">
											<span class="label">Phone Number</span>
										</label>
									</div>
								</div> 


								<div class="form-row" id="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="first_name" name="first_name" required>
											<span class="label">First Name</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="last_name" name="last_name" required>
											<span class="label">Last Name</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="phone" name="phone" required>
											<span class="label">Phone Number</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="your_email_1" id="your_email_1" class="form-control"  required>
											<span class="label">E-Mail</span>
										</label>
									</div>
								</div>
								
								
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="address" name="address" required>
											<span class="label">My Location</span>
										</label>
									</div>
								</div>
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<p class="step-icon"><span>2</span></p>
			            	<span class="step-text">Select Vehicle</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3>Select your Cargo Weight</h3>
			                		<span>2/4</span>
			                	</div>
		                		<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="address" name="address" required>
											<span class="label">My Location</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="room" class="special-label-1">Describe your Cargo</label>
										<select name="room" id="room" class="form-control">
											<option value="Daily Design Metting - Metting Room No.1" selected>Select Vehicle Type</option>
											<option value="Single">Motorcycle(10kg)</option>
											<option value="Double">Car(20kg)</option>
										</select>
										<span class="select-btn">
											<i class="zmdi zmdi-chevron-down pt-2"></i>
										</span>
									</div>
								</div>
								
							</div>
			            </section>
			           
			            <h2>
			            	<p class="step-icon"><span>3</span></p>
			            	<span class="step-text">Destination</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3></h3>
			                		<span>3/4</span>
			                	</div>
		                		
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="room" class="special-label-1">Your Location</label>
										<input name="room" id="room" class="form-control" placeholder="select the closet road map to you">
											
										</select>
										<span class="select-btn">
											<i class="zmdi zmdi-chevron-down"></i>
										</span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="room" class="special-label-1">Recievers Location</label>
										<input name="room" id="room" class="form-control" placeholder="select the closet road map to you">
											
										</select>
										<span class="select-btn">
											<i class="zmdi zmdi-chevron-down"></i>
										</span>
									</div>
								</div>
							</div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<p class="step-icon"><span>4</span></p>
			            	<span class="step-text">Send Consignment</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3>Comfirm Details</h3>
			                		<span>4/4</span>
			                	</div>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>Consignment Details:</th>
												<td >1kg Percel of envilope</td>
											</tr>
											<tr class="space-row">
												<th>Estimated Distance</th>
												<td >3km</td>
											</tr>
											<tr class="space-row">
												<th>Estmated Time of Delivery</th>
												<td >50mins Less traffic</td>
											</tr>
											
											<tr class="space-row">
												<th>Consignment Cost:</th>
												<td >N4000</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			            </section>
		        	</div>
		        </form> 
			</div> 
     </div>
</div>    


@endsection







