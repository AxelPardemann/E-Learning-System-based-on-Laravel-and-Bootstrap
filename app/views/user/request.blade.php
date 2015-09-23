@extends('layouts.defaultLogin')
@section('content')

<div class="requestpanel">
    <div class="row">
            <div class="mb20"></div>        
    </div>
    <div class="row">        
        {{ Form::open(array('url' => url('user/request'), 'autocomplete' => 'off', 'class' =>'login-form','id'=>'request_form' )) }}            
            @if (!is_null(Session::get('status_error')))
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>
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
                <a class="close" data-dismiss="alert" href="#">×</a>
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
            <div class="col-md-7">
				<div class="form-group">
                <input type="text" class="form-control email" placeholder="Required" name="email" />   
				<span class="help-block">
				</span>	
				</div>    
            </div>            
            <div class="col-md-3">
                <button class="btn btn-success btn-block">Submit</button>
            </div>
            <div class="clear"></div>                        
        {{ Form::close() }}        
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
            var form1 = $('#request_form');
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