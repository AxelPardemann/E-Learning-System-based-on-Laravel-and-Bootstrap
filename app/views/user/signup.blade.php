@extends('layouts.default')

@section('pageContainer')
<section>
  
    <div class="signuppanel">
        
        <div class="row">
            
            <div class="col-md-6">
                
                <div class="signup-info">
                    <div class="logopanel">
                        <h1><span>[</span> {{Config::get('app.title')}} <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Bootstrap 3 Admin Template!</strong></h5>
                    <p>Bracket is a theme that is perfect if you want to create your own content management, monitoring or any other system for your project.</p>
                    <p>Below are some of the benefits you can have when purchasing this template.</p>
                    <div class="mb20"></div>
                    
                    <div class="feat-list">
                        <i class="fa fa-wrench"></i>
                        <h4 class="text-success">Easy to Customize</h4>
                        <p>Bracket is made using Bootstrap 3 so you can easily customize any element of this template following the structure of Bootstrap 3.</p>
                    </div>
                    
                    <div class="feat-list">
                        <i class="fa fa-compress"></i>
                        <h4 class="text-success">Fully Responsive Layout</h4>
                        <p>Bracket is design to fit on all browser widths and all resolutions on all mobile devices. Try to scale your browser and see the results.</p>
                    </div>
                    
                    <div class="feat-list mb20">
                        <i class="fa fa-search-plus"></i>
                        <h4 class="text-success">Retina Ready</h4>
                        <p>When a user load a page, a script checks each image on the page to see if there's a high-res version of that image. If a high-res exists, the script will swap that image in place.</p>
                    </div>
                    
                    <h4 class="mb20">and much more...</h4>
                
                </div><!-- signup-info -->
            
            </div><!-- col-sm-6 -->
            
            <div class="col-md-6">
               {{ Form::open(array('url' => 'user/register','autocomplete' => 'off', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'submit_form')) }}                   
                    <h3 class="nomargin">Sign Up</h3>
                    <p class="mt5 mb20">Already a member? <a href="{{URL::route("user/login")}}"><strong>Sign In</strong></a></p>            
                   
                    <div class="mb10">
						<div class="form-group">
							<label class="control-label">Email <span class="asterisk">*</span></label>
							<input type="text" class="form-control" placeholder="Required" name="email" />
							<span class="help-block"></span>							
						</div>
                    </div>

                    <div class="mb10">
							<div class="form-group">
							<label class="control-label">First name <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" placeholder="Required" name="firstname" />
							<span class="help-block">
							</span>
							</div>
                    </div>
 
                    <div class="mb10">
						<div class="form-group">
							<label class="control-label">Last name <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" placeholder="Required" name="lastname" />
							<span class="help-block">
							</span>
						</div>
                    </div>		
                    
                    <div class="mb10">
						<div class="form-group">
							<label class="control-label">Password <span class="asterisk">*</span></label>
							<input type="password" class="form-control" placeholder="Required" name="password" id="submit_form_password" />
							<span class="help-block">
							</span>
						</div>
                    </div>
                    
                    <div class="mb10">
						<div class="form-group">
							<label class="control-label">Retype Password <span class="asterisk">*</span></label>
							<input type="password" class="form-control" placeholder="Required" name="password_confirmation" />
							<span class="help-block">
							</span>
						</div>
                    </div>
                    
                    <label class="control-label">Birthday</label>
                    <div class="row mb10">
                        <div class="col-sm-5">
                            <select class="form-control chosen-select" data-placeholder="Month" name="month">
                                <option value=""></option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="Day" name="day" />
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Year" name="year" />
                        </div>
                    </div>                  

                    <div class="mb10">
						<div class="form-group">
							<label class="control-label">Location</label>
							<select class="form-control chosen-select" data-placeholder="Choose a Country..." name="country">
							  <option value=""></option>
							  <option value="US">United States</option>
							  <option value="UK">United Kingdom</option>
							  <option value="CHN">China</option>                         
							  <option value="DEN">Denmark</option>
							</select>
							<span class="help-block">								
							</span>
						</div>
                    </div>
                    <br />
                    <button class="btn btn-success btn-block">Sign Up</button>
                {{ Form::close() }}   			
            </div><!-- col-sm-6 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved. Bracket Bootstrap 3 Admin Template
            </div>
            <div class="pull-right">
                Created By: <a href="http://themepixels.com/" target="_blank">ThemePixels</a>
            </div>
        </div>
        
    </div><!-- signuppanel -->
  
</section>
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
	   // initiate layout and plugins
	   $( '#mainbody' ).addClass('signin');
	   FormValidation.init();        
        // Chosen Select
        jQuery(".chosen-select").chosen({
            'width':'100%',
            'white-space':'nowrap',
            disable_search: true
        });        
    });

	var FormValidation = function () {

		var handleValidation1 = function() {
			// for more info visit the official plugin documentation: 
			var form1 = $('#submit_form');
			var error1 = $('.alert-danger', form1);
			//var success1 = $('.alert-success', form1);
			form1.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",
				rules: {
                    firstname: {
                        minlength: 1,
                        required: true
                    },
                    lastname: {
                        minlength: 1,
                        required: true
                    },                    
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 5,
                        required: true
                    },
                    password_confirmation: {
                        minlength: 5,
                        required: true,
                        equalTo: "#submit_form_password"
                    },
                    day: {
                        number: true,
                        min:1,
                        max:31
                    },
                    year: {
                        number: true,
                        maxlength:4,
                        min:1900                        
                    },
				},

				invalidHandler: function (event, validator) { //display error alert on form submit              
					//success1.hide();
					error1.show();
					App.scrollTo(error1, -200);
				},

				highlight: function (element) { // hightlight error inputs
					$(element)
						.closest('.form-group').addClass('has-error'); // set error class to the control group
				},

				unhighlight: function (element) { // revert the change done by hightlight
					$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
				},

				success: function (label) {
					label
						.closest('.form-group').removeClass('has-error'); // set success class to the control group
				},

				submitHandler: function (form) {
						error1.hide();
						form.submit();
				}
			});
		}
		return {
			//main function to initiate the module
			init: function () {
				handleValidation1();
			}
		};
	}();	
</script>
@endsection