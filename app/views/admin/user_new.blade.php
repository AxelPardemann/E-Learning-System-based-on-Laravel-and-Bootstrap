@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
@endsection
@section('pageContainer')
<div class="pageheader">
  <h2><i class="fa fa-user"></i> Add New User <span></span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
	  <li><a href="{{URL::route('admin/dashboard')}}">{{Config::get('app.title')}}</a></li>
      <li><a href="{{URL::route('admin/users')}}">{{$title}}</a></li>
      <li class="active">Add User</li>
    </ol>
  </div>
</div>
<div class="contentpanel"> 
	<div class="row">
      <div class="col-md-12">          
          {{Form::open(array('url' => 'user/add', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'userAdd', 'autocomplete' => 'off'))}}
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 class="panel-title">Owner Information</h4>                
              </div>
              <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 mb10">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">First Name <span class="asterisk">*</span></label>
                          <div class="col-sm-7">
                            <input type="text" name="firstname" placeholder="First Name" class="form-control">
                            <span for="firstname" class="help-block"></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb10">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Last Name <span class="asterisk">*</span></label>
                          <div class="col-sm-7">
                            <input type="text" name="lastname" placeholder="Last Name" class="form-control">
                            <span for="lastname" class="help-block"></span>
                          </div>
                        </div>
                    </div>                
                </div>
                <div class="row">
                    <div class="col-md-6 mb10">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Password <span class="asterisk">*</span></label>
                          <div class="col-sm-7">
                            <input type="password" name="password" placeholder="Password" id="submit_form_password" class="form-control">
                            <span for="password" class="help-block"></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb10">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Confirm Password <span class="asterisk">*</span></label>
                          <div class="col-sm-7">
                            <input type="password" name="password_confirmation" placeholder="Re-type Password" class="form-control">
                            <span for="password_confirmation" class="help-block"></span>
                          </div>
                        </div>
                    </div>                
                </div>                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label">Birthday</label>
                            <div class="row col-sm-7">
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
                                    <span for="day" class="help-block"></span>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Year" name="year" />
                                    <span for="year" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Permission <span class="asterisk">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control chosen-select" data-placeholder="Permission" name="permission">
                                  <option value=""></option>
                                  <option value="administrator">Administrator</option>
                                  <option value="teacher">Teacher</option>
                                  <option value="student">Student</option>
                                </select>
                                <span for="permission" class="help-block"></span>
                            </div>
                          </div>
                    </div>                
                </div>                
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Publish </label>
                          <div class="col-sm-6">
                             <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
                             <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
                          </div>
                        </div>
                </div>              
              </div>
              <!-- panel-body -->
              <div class="panel-footer panel-heading">
                  <h4 class="panel-title">Contact information</h4>                
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-6 mb10">
                          <div class="form-group">
                            <label class="col-sm-5 control-label">Email address <span class="asterisk">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" name="email" placeholder="Email" class="form-control">
                              <span for="email" class="help-block"></span>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6 mb10">
                          <div class="form-group">
                            <label class="col-sm-5 control-label">Location</label>
                            <div class="col-sm-7">
                                <select class="col-sm-7 form-control chosen-select" data-placeholder="Choose a Country..." name="country">
                                  <option value=""></option>
                                  <option value="US">United States</option>
                                  <option value="UK">United Kingdom</option>
                                  <option value="CHN">China</option>                         
                                  <option value="DEN">Denmark</option>
                                </select>
                                <span for="country" class="help-block"></span>
                            </div>                            
                          </div>
                      </div>                      
                  </div>                  
              </div>
              <div class="panel-footer actions">
                <button class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div><!-- panel-footer -->
            </div><!-- panel-default -->
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
      var form1 = $('#userAdd');
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
                    password: {
                        minlength: 5,
                        required: true
                    },
                    password_confirmation: {
                        minlength: 5,
                        required: true,
                        equalTo: "#submit_form_password"
                    },                                    
                    email: {
                        required: true,
                        email: true
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
                    permission: {
                        required: true
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
