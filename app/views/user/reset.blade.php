@extends('layouts.defaultLogin')
@section('content')
<div class="resetpanel">
    <div class="row">
    	<div class="col-md-5">
    		<div class="logopanel">
	            <h1><span>[</span> {{Config::get('app.title')}} <span>]</span></h1>
	        </div><!-- logopanel -->
	    
	        <div class="mb20"></div>
	    
	        <h4><strong>Reset Password</strong></h4>
	        <p>Please enter your email address and reset new password. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br /><a href="{{URL::route('user/login')}}">Sign In</a></p>
	        <p></p>            
	        <div class="mb20"></div> 
    	</div>
    	<div class="col-md-7">        
        {{ Form::open(array('url' => URL::route("user/reset") . $token, 'autocomplete' => 'off', 'class' =>'login-form','id'=>'reset_form' )) }}            
            @if (!is_null(Session::get('status_error')))
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">¡¿</a>
                <h4 class="alert-heading">Error!</h4>
                @if (is_array(Session::get('status_error')))
                    <ul>
                    @foreach (Session::get('status_error') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @else
                    {{ Session::get('status_error') }}
                @endif
            </div>
            @endif
            @if (!is_null(Session::get('status_success')))
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">¡¿</a>
                <h4 class="alert-heading">Success!</h4>
                @if (is_array(Session::get('status_success')))
                    <ul>
                    @foreach (Session::get('status_success') as $success)
                        <li>{{ $success }}</li>
                    @endforeach
                    </ul>
                @else
                    {{ Session::get('status_success') }}
                @endif
            </div>
            @endif
                            
                <div class="form-group">
					<label class="control-label">Email <span class="asterisk">*</span></label>
					<input type="text" class="form-control email" placeholder="Email" name="email" />
					<span class="help-block">
					</span>
				</div>                
                <div class="form-group">
					<label class="control-label">Password <span class="asterisk">*</span></label>
					<input type="password" class="form-control pword" placeholder="Password" name="password" id="submit_form_password" />
					<span class="help-block">
					</span>
				</div>
                <div class="form-group">
					<label class="control-label">Retype Password <span class="asterisk">*</span></label>
					<input type="password" class="form-control pword" placeholder="Confirm Password" name="password_confirmation" />
					<span class="help-block">
					</span>
				</div>         
            
                <button class="btn btn-success btn-block">Submit</button>            
        {{ Form::close() }}
        </div>        
    </div>
</div>
@endsection

@section('javaScript')
<script>
    jQuery(document).ready(function(){
       // initiate layout and plugins
       FormValidation.init();        
    });

    var FormValidation = function () {

        var handleValidation1 = function() {
            // for more info visit the official plugin documentation: 
            var form1 = $('#reset_form');
            var error1 = $('.alert-danger', form1);
            //var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {                    
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
                        //error1.hide();
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