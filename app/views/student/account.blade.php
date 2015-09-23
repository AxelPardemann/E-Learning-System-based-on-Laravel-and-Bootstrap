@extends('layouts.default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
@endsection

@section('pageContainer')  
  <div class="mainpanel">
    <!-- headerbar -->
    @section('headerbar')
      @include('student.student_nav')
    @endsection
    
    <div class="contentpanel school-panel">
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
        <div class="row">
            <div class="col-md-12">          
                {{Form::open(array('url' => 'account/update', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'accountSetting', 'autocomplete' => 'off'))}}
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
                                  <input type="text" name="firstname" placeholder="Required" value="{{$user->first}}" class="form-control">
                                  <span for="firstname" class="help-block"></span>
                                </div>
                              </div>
                          </div>
                          <div class="col-md-6 mb10">
                              <div class="form-group">
                                <label class="col-sm-5 control-label">Last Name <span class="asterisk">*</span></label>
                                <div class="col-sm-7">
                                  <input type="text" name="lastname" placeholder="Required" value="{{$user->last}}" class="form-control">
                                  <span for="lastname" class="help-block"></span>
                                </div>
                              </div>
                          </div>                
                      </div>                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-sm-5 control-label">New Password</label>
                            <div class="col-sm-7">
                              <input type="password" name="password" class="form-control" placeholder="Enter new password.">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-sm-5 control-label">Confirm password</label>
                            <div class="col-sm-7">
                              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password.">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                      </div>                                    
                    </div><!-- panel-body -->
                    <div class="panel-footer panel-heading">
                        <h4 class="panel-title">Contact information</h4>                
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 mb10">
                                <div class="form-group">
                                  <label class="col-sm-5 control-label">Email address <span class="asterisk">*</span></label>
                                  <div class="col-sm-7">
                                    <input type="text" name="email" placeholder="Email" value="{{$user->email}}" disabled class="form-control">
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
                        <div class="row">
                            <div class="col-md-6 mb10">
                                <div class="form-group">
                                  <label class="col-sm-5 control-label">Address </label>
                                  <div class="col-sm-7">
                                    <input type="text" name="address" placeholder="Optional" class="form-control">
                                    <span for="address" class="help-block"></span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb10">
                                <div class="form-group">
                                                        
                                </div>
                            </div>                      
                        </div> 
                    </div>
                    <div class="panel-footer actions">
                      <button class="btn btn-primary">Save</button>
                      @if ($user->permission == "student")
                      <a href="{{URL::route('student/home')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                      @else
                      <a href="{{URL::route('teacher/home')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                      @endif
                    </div><!-- panel-footer -->
                  </div><!-- panel-default -->
                {{ Form::close() }}
            </div>      
        </div>          
      <!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->  
@endsection

@section('pageLevelPlugins')
{{HTML::script('assets/js/retina.min.js')}}
{{HTML::script('assets/js/jquery.cookies.js')}}

{{HTML::script('assets/js/jquery.sparkline.min.js')}}
{{HTML::script('assets/js/toggles.min.js')}}
{{HTML::script('assets/js/custom.js')}}
@endsection

@section('javaScript')

<script>
jQuery(document).ready(function() { 
	$( '#mainbody' ).addClass('horizontal-menu');
});

  var FormValidation = function () {

    var handleValidation1 = function() {
      // for more info visit the official plugin documentation: 
      var form1 = $('#accountSetting');
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