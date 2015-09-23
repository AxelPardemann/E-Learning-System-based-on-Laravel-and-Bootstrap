@extends('layouts.admin_default')

@section('globalStyles')
{{HTML::style('assets/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}
{{HTML::style('assets/bootstrap-modal/css/bootstrap-modal.css')}}
{{HTML::style('assets/css/jquery.datatables.css')}}

{{HTML::style('assets/css/jquery.fileupload.css')}}
{{HTML::style('assets/css/jquery.fileupload-ui.css')}}

<!-- BEGIN CONFIRM DIALOG -->
{{HTML::style('assets/css/styles.css')}}
{{HTML::style('assets/js/jquery.confirm/jquery.confirm.css')}}
<!-- END CONFIRM DIALOG -->

@endsection

@section('pageContainer')        
    <div class="contentpanel">   
       {{Form::open(array('url' => 'asset/delete', 'method' => 'post', 'id' => 'assetDelete'))}}   
        <input type="hidden" name="assetFile" id="assetFile">
        <input type="hidden" name="assetType" id="assetType">
       {{Form::close()}}
      <div class="row">
        {{Form::open(array('url' => 'sprint/add', 'method' => 'post', 'id' => 'sprintAdd', 'class' => 'form-horizontal form-bordered'))}}   
        <input type="hidden" name="id" value="@if($sprintById != null){{$sprintById->id}}@endif">
        @if ($sprintById == null)
          <input type="hidden" name="course" id="course" value="{{$course}}">
        @else 
          <input type="hidden" name="course" id="course" value="{{$sprintById->course}}">
        @endif
        <div class="contentlist">
          <!--<div class="sprint-info col-md-12">-->
          <div class="panel panel-default">
            <div class="panel-heading">
                  <h4 class="panel-title">Sprint Information</h4>                
            </div>
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
                  {{ Session::get('status_error')}}
                @endif
              </div>
              @endif
          
            <div class="panel-body"> 
                @if ($sprintById == null && $course == "")
                <div class="form-group">
                  <label class="col-sm-3 control-label">Chosen Course <span class="asterisk">*</span></label>
                  <div class="col-sm-5">
                    <select class="form-control chosen-select" data-placeholder="Choose a Course..." id="courses" required>
                      <option value=""></option>
                      @foreach($courses as $tmpcourse)
                      <option value="{{$tmpcourse->id}}">{{$tmpcourse->name}}</option>
                      @endforeach              
                    </select>
                    <span for="courses" class="help-block"></span>
                  </div>
                </div>
                @endif
                <div class="form-group">
                  <label class="col-sm-3 control-label">Name <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" id="name" name="name" placeholder="Required" class="form-control" value="@if($sprintById != null){{$sprintById->name}}@endif" />
                    <span class="help-block">Please enter the name</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description <span class="asterisk">*</span></label>
                  <div class="col-sm-7">
                    <textarea class="form-control" id="description" name="description" placeholder="Required" rows="5">@if($sprintById != null){{$sprintById->description}}@endif</textarea>
                    <span class="help-block">Please enter the description</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Fluency rate <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" id="fluency" name="fluency" placeholder="Required" class="form-control" value="@if($fluency != null){{$fluency}}@endif" />
                    <span class="help-block">Please enter the fluency rate</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Publish </label>
                  <div class="col-sm-6">
                    @if ($sprintById != null && $sprintById->published == 1)
                     <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
                     <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>
                    @elseif ($sprintById != null && $sprintById->published == 0)
                     <div class="radio"><label><input type="radio" name="publish" value="1"> Yes</label></div>
                     <div class="radio"><label><input type="radio" name="publish" checked="" value="0"> No</label></div>
                    @else
                     <div class="radio"><label><input type="radio" name="publish" checked="" value="1"> Yes</label></div>
                     <div class="radio"><label><input type="radio" name="publish" value="0"> No</label></div>                    
                    @endif
                    </div>
                </div> 
            </div><!-- panel-body --> 
          </div>

          <div class="card-info col-md-12">
            <div class="panel-heading">
                  <h4 class="panel-title">Card Information</h4>                
            </div>
            <div class="row">
              <div class="col-md-5 front">
                <div class="form-group">
                  <center>Front side</center>
                </div>
              </div>
              <div class="col-md-7 back"> 
                <div class="form-group">
                  <center>Back side</center>
                </div>
              </div>              
            </div> 

            <div class="col-md-12 cards">              
              <ul>
                @if ($cardsBysprint != null)
                <?php $i = 0; ?>
                @foreach($cardsBysprint as $card)
                  <input type="hidden" name="card_ids[]" value="{{$card->id}}">
                  @if ($i % 2 == 1)                    
                    <li id="row-{{$i + 1}}" class="col-md-12 even">
                  @else
                    <li id="row-{{$i + 1}}" class="col-md-12">
                  @endif
                  <input type="hidden" id="card_type-{{$i + 1}}" value="{{$card->card_type}}">
                  <div class="col-md-5">
                      <div>
                          <span class="text @if($card->f_text_option == 1) btn-primary @else btn-white @endif">Text</span>
                          <span class="sound @if($card->f_sound_option == 1) btn-primary @else btn-white @endif">Sound</span>
                          <span class="image @if($card->f_image_option == 1) btn-primary @else btn-white @endif">Image</span>

                          @if ($card->f_text_option == 1) 
                              <input type="hidden" value="1" name="f_text_option[]" />
                          @else
                              <input type="hidden" value="0" name="f_text_option[]" />
                          @endif

                          <input type="text" name="f_text[]" value="{{$card->f_text}}">
                          <input class="option" type="hidden" value="{{$card->card_type}}" name="cardtype[]">
                          <div style="clear: both;"></div>
                      </div>
                      <div>
                          @if ($card->f_sound_option == 1)                         
                            <input id="f_sound-{{$i + 1}}" type="hidden" value="{{$card->f_sound_path}}{{$card->f_sound}}" name="f_sound[]">
                            <div id="f_sound_previewer-{{$i + 1}}" 
                              style="@if ($card->f_sound == "") display:none; @else display:block; @endif padding-right:20px;">
                                <div id="f_sound_preview-{{$i + 1}}">
                                  <p><audio id="f_audio-{{$i + 1}}" controls="" src="{{$card->f_sound_path}}{{$card->f_sound}}"></audio></p> 
                                </div>
                                <div id="f_sound_delete-{{$i + 1}}">
                                  <button type="button" data-key="{{$i + 1}}" class="btn btn-default btn-xs delete-asset-front" data-toggle="modal">
                                  <i class="fa fa-minus"></i> Delete Sound</button>
                                </div>
                            </div>
                            <div id="f_sound_add-{{$i + 1}}" 
                              style="@if ($card->f_sound != "") display:none; @else display:block; @endif padding-right:20px;">
                                <button type="button" class="btn btn-default btn-xs sound-modal-ajax" id="sound-modal-ajax" 
                                data-key="{{$i + 1}}" data-toggle="modal" 
                                data-url="{{URL::route('modals/addSound', array('type'=>'front', 'id'=>'')) }}">
                                <i class="fa fa-plus"></i> Add Sound...</button>
                            </div>                            
                          @else 
                            <input id="f_sound-{{$i + 1}}" type="hidden" value="none" name="f_sound[]">
                          @endif
                      </div>

                      <div>
                          @if ($card->f_image_option == 1)
                            <input id="f_image-{{$i + 1}}" type="hidden" value="{{$card->f_image_path}}{{$card->f_image}}" name="f_image[]">

                            <div id="f_image_previewer-{{$i + 1}}" style="@if ($card->f_image == "")display:none; @else display:block; @endif">
                                <div id="f_image_preview-{{$i + 1}}">
                                    <img id="f_img-{{$i + 1}}" src='{{$card->f_image_path}}{{$card->f_image}}' />
                                </div>
                                <div id="f_image_delete-{{$i + 1}}">
                                <button type="button" data-key="{{$i + 1}}" class="btn btn-default btn-xs delete-asset-front" data-toggle="modal">
                                <i class="fa fa-minus"></i> Delete Image</button>
                                </div>
                            </div>                            
                            <div id="f_image_add-{{$i + 1}}" 
                              style="@if ($card->f_image != "") display:none; @else display:block; @endif display:block;">
                                <button type="button" class="btn btn-default btn-xs image-modal-ajax" id="image-modal-ajax" 
                                data-key="{{$i + 1}}" data-toggle="modal" 
                                data-url="{{URL::route('modals/addImage', array('type'=>'front', 'id'=>'')) }}">
                                <i class="fa fa-plus"></i> Add Image...</button>
                            </div>                             
                          @else
                            <input id="f_image-{{$i + 1}}" type="hidden" value="none" name="f_image[]">
                          @endif
                      </div>
                  </div>

                  <div class="col-md-7">
                    @if ($card->card_type == "singlecard") 
                        <div>
                                <span class="text @if($card->b_text_option == 1) btn-primary @else btn-white @endif">Text</span>
                                <span class="sound @if($card->b_sound_option == 1) btn-primary @else btn-white @endif">Sound</span>
                                <span class="image @if($card->b_image_option == 1) btn-primary @else btn-white @endif">Image</span>    

                                @if ($card->card_type == "radiocard") 
                                  <input type="radio" checked="" class="optionbtn" name="option-{{$i+1}}" value="1" />
                                @elseif ($card->card_type == "checkcard")
                                  <input type="checkbox" class="optionbtn" name="check-{{$i+1}}[]" value="1" />
                                @endif                               

                                <a class="btn btn-white delete-card" data-key="{{$card->id}}">Delete Card</a>
                                <a class="btn btn-white new-option" disabled="disabled">New Option</a>

                                @if ($card->b_text_option == 1) 
                                    <input type="hidden" value="1" name="b_text_option-{{$i + 1}}[]" />
                                @else
                                    <input type="hidden" value="0" name="b_text_option-{{$i + 1}}[]" />
                                @endif

                                <input type="text" name="b_text-{{$i + 1}}[]" value="{{$card->b_text}}">
                                <div style="clear: both;"></div>
                                @if ($card->b_sound_option == 1)
                                  <input id="b_sub_sound-{{$i + 1}}-1" type="hidden" name="b_sound-{{$i + 1}}[]" value="{{$card->b_sound_path}}{{$card->b_sound}}">

                                  @if ($card->b_image_option == 1)
                                    <div id="b_sound_previewer-{{$i + 1}}-1" 
                                      style="@if ($card->b_sound != "") display:block; @else display:none; @endif padding-right:20px;">                                
                                  @else
                                    <div id="b_sound_previewer-{{$i + 1}}-1" 
                                      style="@if ($card->b_sound != "") display:block; @else display:none; @endif">                                 
                                  @endif
                                        <div id="b_sound_preview-{{$i + 1}}-1">
                                          <p><audio id="b_audio-{{$i + 1}}-1" controls="" src="{{$card->b_sound_path}}{{$card->b_sound}}"></audio></p> 
                                        </div> 
                                        <div id="b_sound_delete-{{$i + 1}}-1">
                                          <button type="button" data-key="{{$i + 1}}-1" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">
                                          <i class="fa fa-minus"></i> Delete Sound</button>
                                        </div>
                                    </div> 
                                  @if ($card->b_image_option == 1)
                                      <div id="b_sound_add-{{$i + 1}}-1" 
                                        style="@if ($card->b_sound == "") display:block; @else display:none; @endif padding-right:20px;">                                
                                  @else
                                      <div id="b_sound_add-{{$i + 1}}-1" 
                                        style="@if ($card->b_sound == "") display:block; @else display:none; @endif">                                    
                                  @endif
                                          <button type="button" class="btn btn-default btn-xs b-sound-modal-ajax" id="b-sound-modal-ajax-{{$i + 1}}" 
                                              data-key="1" data-parent="{{$i + 1}}" data-toggle="modal" 
                                              data-url="{{URL::route('modals/addSound', array('type'=>'back', 'id'=>'')) }}">
                                              <i class="fa fa-plus"></i> Add Sound...
                                          </button>
                                      </div>
                                @else 
                                  <input type="hidden" value="none" name="b_sound-{{$i + 1}}[]" id="b_sub_sound-{{$i + 1}}-1" />
                                @endif

                                @if ($card->b_image_option == 1)
                                  <input type="hidden" name="b_image-{{$i + 1}}[]" id="b_sub_image-{{$i + 1}}-1" value="{{$card->b_image_path}}{{$card->b_image}}"/>
                                  <div id="b_image_previewer-{{$i + 1}}-1" 
                                    style="@if ($card->b_image == "")display:none; @else display:block; @endif">
                                    <div id="b_image_preview-{{$i + 1}}-1">
                                        <img id="b_img-{{$i + 1}}-1" src='{{$card->b_image_path}}{{$card->b_image}}' />
                                    </div>
                                    <div id="b_image_delete-{{$i + 1}}-1">
                                      <button type="button" data-key="{{$i + 1}}-1" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">
                                      <i class="fa fa-minus"></i> Delete Image</button>
                                    </div>
                                  </div>

                                  <div id="b_image_add-{{$i + 1}}-1" .
                                    style="@if ($card->b_image == "")display:block; @else display:none; @endif">
                                    <button type="button" class="btn btn-default btn-xs b-image-modal-ajax" id="b-image-modal-ajax-{{$i + 1}}" 
                                    data-key="1" data-parent="{{$i + 1}}" data-toggle="modal" 
                                    data-url="{{URL::route('modals/addImage', array('type'=>'back', 'id'=>'')) }}">
                                    <i class="fa fa-plus"></i> Add Image...</button>
                                  </div>                       
                                @else
                                  <input type="hidden" value="none" name="b_image-{{$i + 1}}[]" id="b_sub_image-{{$i + 1}}-1" />
                                @endif
                        </div>
                    @elseif ($card->card_type == "radiocard" || $card->card_type == "checkcard") 
                        <?php $j = 0; ?>                        
                        @foreach(BaseController::getSubcards($card->id) as $subcard)                          
                          <div>                          
                          <input type="hidden" name="subcard_id-{{$i + 1}}[]" value="{{$subcard->id}}">
                          <span class="text @if($subcard->b_text_option == 1) btn-primary @else btn-white @endif">Text</span>
                          <span class="sound @if($subcard->b_sound_option == 1) btn-primary @else btn-white @endif">Sound</span>
                          <span class="image @if($subcard->b_sound_option == 1) btn-primary @else btn-white @endif">Image</span>

                          @if ($card->card_type == "radiocard")
                            @if ($subcard->correctanswer == 1)
                              <input type="radio" class="optionbtn" checked="" name="option-{{$i + 1}}" value="{{$j + 1}}" />
                            @else
                              <input type="radio" class="optionbtn" name="option-{{$i + 1}}" value="{{$j + 1}}" />
                            @endif
                          @else
                            @if ($subcard->correctanswer == 1)
                              <input type="checkbox" class="optionbtn" checked="" name="check-{{$i + 1}}[]" value="{{$j + 1}}" />
                            @else
                              <input type="checkbox" class="optionbtn" name="check-{{$i + 1}}[]" value="{{$j + 1}}" />
                            @endif
                          @endif

                          <a class="btn btn-white delete-card" data-key="{{$card->id}}">Delete Card</a>
                          <a class="btn btn-white new-option" data-key="{{$i + 1}}">New Option</a>

                          @if ($subcard->b_text_option == 1) 
                              <input type="hidden" value="1" name="b_text_option-{{$i + 1}}[]" />
                          @else
                              <input type="hidden" value="0" name="b_text_option-{{$i + 1}}[]" />
                          @endif

                          <input type="text" name="b_text-{{$i + 1}}[]" value="{{$subcard->answer}}" />
                          <div style="clear: both;"></div>

                          @if ($subcard->b_sound_option == 1) 
                              <input type="hidden" value="{{$subcard->b_sound_path}}{{$subcard->b_sound}}" name="b_sound-{{$i + 1}}[]" id="b_sub_sound-{{$i + 1}}-{{$j + 1}}" />

                              @if ($subcard->b_image_option == 1)
                                  <div id="b_sound_previewer-{{$i + 1}}-{{$j + 1}}" 
                                    style="@if ($subcard->b_sound == "") display:none; @else display:block; @endif padding-right:20px;">
                              @else
                                  <div id="b_sound_previewer-{{$i + 1}}-{{$j + 1}}" 
                                    style="@if ($subcard->b_sound == "") display:none; @else display:block; @endif">
                              @endif
                                    <div id="b_sound_preview-{{$i + 1}}-{{$j + 1}}">
                                      <p><audio id="b_audio-{{$i + 1}}-{{$j + 1}}" controls="" src="{{$subcard->b_sound_path}}{{$subcard->b_sound}}"></audio></p> 
                                    </div>
                                    <div id="b_sound_delete-{{$i + 1}}-{{$j + 1}}">
                                      <button type="button" data-key="{{$i + 1}}-{{$j + 1}}" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">
                                      <i class="fa fa-minus"></i> Delete Sound</button>
                                    </div>
                                  </div>

                              @if ($subcard->b_image_option == 1)
                                  <div id="b_sound_add-{{$i + 1}}-{{$j + 1}}" 
                                    style="@if ($subcard->b_sound == "") display:block; @else display:none; @endif padding-right:20px;">
                              @else
                                  <div id="b_sound_add-{{$i + 1}}-{{$j + 1}}" 
                                    style="@if ($subcard->b_sound == "") display:block; @else display:none; @endif">
                              @endif

                                    <button type="button" class="btn btn-default btn-xs b-sound-modal-ajax" id="b-sound-modal-ajax-{{$j + 1}}" 
                                      data-key="{{$j + 1}}" data-parent="{{$i + 1}}" data-toggle="modal" 
                                      data-url="{{URL::route('modals/addSound', array('type'=>'back', 'id'=>'')) }}">
                                      <i class="fa fa-plus"></i> Add Sound...
                                    </button>
                                  </div>
                          @else
                              <input type="hidden" value="none" name="b_sound-{{$i + 1}}[]" id="b_sub_sound-{{$i + 1}}-{{$j + 1}}" />
                          @endif

                          @if ($subcard->b_image_option == 1) 
                              <input type="hidden" value="{{$subcard->b_image_path}}{{$subcard->b_image}}" name="b_image-{{$i + 1}}[]" id="b_sub_image-{{$i + 1}}-{{$j + 1}}" />
                              
                              <div id="b_image_previewer-{{$i + 1}}-{{$j + 1}}" style="@if ($subcard->b_image == "")display:none; @else display:block; @endif">
                                  <div id="b_image_preview-{{$i + 1}}-{{$j + 1}}">
                                      <img id="b_img-{{$i + 1}}-{{$j+1}}" src='{{$subcard->b_image_path}}{{$subcard->b_image}}' />
                                  </div>
                                  <div id="b_image_delete-{{$i + 1}}-{{$j + 1}}">
                                    <button type="button" data-key="{{$i + 1}}-{{$j + 1}}" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">
                                    <i class="fa fa-minus"></i> Delete Image</button>
                                    </div>
                              </div>

                              <div id="b_image_add-{{$i + 1}}-{{$j + 1}}" 
                                style="@if ($subcard->b_image == "") display:block; @else display:none; @endif">
                                <button type="button" class="btn btn-default btn-xs b-image-modal-ajax" id="b-image-modal-ajax-{{$j + 1}}" 
                                  data-key="{{$j + 1}}" data-parent="{{$i + 1}}" data-toggle="modal" 
                                  data-url="{{URL::route('modals/addImage', array('type'=>'back', 'id'=>'')) }}">
                                  <i class="fa fa-plus"></i> Add Image...
                                </button>
                              </div>                              
                          @else
                              <input type="hidden" value="none" name="b_image-{{$i + 1}}[]" id="b_sub_image-{{$i + 1}}-{{$j + 1}}" />
                          @endif
                        </div>
                        <?php $j++; ?>
                        @endforeach
                    @endif
                  </div>
                  </li>
                  <?php $i++; ?>
                @endforeach
                @endif
              </ul>
            </div>

            <div class="col-md-5 front">
              <a id="f_text_btn" class="btn btn-white">Text</a>
              <a id="f_sound_btn" class="btn btn-white">Sound</a>
              <a id="f_image_btn" class="btn btn-white">Image</a>
            </div>
            <div class="col-md-7 back">              
              <a id="b_text_btn" class="btn btn-white">Text</a>
              <a id="b_sound_btn" class="btn btn-white">Sound</a>
              <a id="b_image_btn" class="btn btn-white">Image</a>
              <div class="btn-group">
                <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                  Type of Card <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a>Fill in Blank</a></li>
                  <li><a>Single Choice</a></li>
                  <li><a>Multi Choice</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="panel-footer">
           <div class="form-actions right">
            <div class="col-sm-12 col-sm-offset-3">
              
              <button class="btn btn-success" id="btnSubmit">Submit</button>&nbsp;
              <a href="{{URL::route('admin/sprints')}}" class="btn btn-default"> Cancel</a> 
            </div>
           </div>
          </div><!-- panel-footer -->
        </div>
        {{Form::close()}}
      </div><!-- row -->       
    </div><!-- contentpanel -->    
  
<div id="full-width" class="modal container fade" tabindex="-1">
</div>
@endsection

@section('pageLevelPlugins')
{{HTML::script('assets/js/jquery.datatables.min.js')}}
{{HTML::script('assets/js/jquery.autogrow-textarea.js')}}

<!-- BEGIN UPLOADER -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
{{HTML::script('assets/js/jquery_uploader/vendor/jquery.ui.widget.js') }}
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
{{HTML::script('assets/js/jquery_uploader/jquery.iframe-transport.js') }}
<!-- The basic File Upload plugin -->
{{HTML::script('assets/js/jquery_uploader/jquery.fileupload.js') }}
<!-- BEGIN END -->

<!-- BEGIN CONFIRM DIALOG -->
{{ HTML::script('assets/js/jquery.form.min.js') }}
{{ HTML::script('assets/js/jquery.confirm/jquery.confirm.js') }}
{{ HTML::script('assets/js/script.js') }}
<!-- END CONFIRM DIALOG -->

@endsection

@section('javaScript')
<script>
var card_type = "";
jQuery(document).ready(function() {
   App.init();

   if ($("#course").val() != "") {
      FormValidationWithoutCourse.init();           
   } else { 
      FormValidationWithCourse.init(); 
   }   
   
   UIExtendedModals.init(); 
  // Chosen Select
  jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});

  $( '#mainbody' ).addClass('horizontal-menu');
  $('.mainpanel').css('height', 'auto');

  // Textarea Autogrow
  $('#sprint_description').autogrow();

  $('.btn').click(function() {
    if (!($(this).is("button")) && $(this).hasClass('btn-white')) {
      $(this).removeClass('btn-white');
      $(this).addClass('btn-primary');
    } else {
      $(this).removeClass('btn-primary');
      $(this).addClass('btn-white');
    }
  });

  $( '#btnSubmit' ).on('click', function(event){
       $(this).removeClass('btn-white');
       $(this).addClass('btn-primary');
  });

  $('.card-info .btn-group li a').click(function() {
    var f_flag = false;
    var b_flag = false;

    if ($('#f_text_btn').hasClass('btn-primary')) f_flag = true;
    if ($('#f_sound_btn').hasClass('btn-primary')) f_flag = true;
    if ($('#f_image_btn').hasClass('btn-primary')) f_flag = true;

    if ($('#b_text_btn').hasClass('btn-primary')) b_flag = true;
    if ($('#b_sound_btn').hasClass('btn-primary')) b_flag = true;
    if ($('#b_image_btn').hasClass('btn-primary')) b_flag = true;

    if (f_flag && b_flag) {
      card_type = $(this).text();
      var card_count = $('.cards ul li').length;
      var appendTxt = '<input type="hidden" name="card_ids[]" value="0">';
      appendTxt += '<li id="row-' + (card_count + 1) + '" class="col-md-12';

      if (card_count % 2 == 1)
        appendTxt += ' even';

      appendTxt += '"><div class="col-md-5"><div>';
      appendTxt += '<span class="text ' + $('#f_text_btn').attr('class') + '">Text</span>';
      appendTxt += '<span class="sound ' + $('#f_sound_btn').attr('class') + '">Sound</span>';
      appendTxt += '<span class="image ' + $('#f_image_btn').attr('class') + '">Image</span>';

      if ($('#f_text_btn').hasClass('btn-primary')) {
          appendTxt += '<input type="hidden" value="1" name="f_text_option[]" />';
      } else {
          appendTxt += '<input type="hidden" value="0" name="f_text_option[]" />';
      }
      appendTxt += '<input type="text" name="f_text[]" />';

      if (card_type == "Single Choice")
        appendTxt += '<input type="hidden" class="option" name="cardtype[]" value="radiocard" />';
      else if (card_type == "Multi Choice") 
        appendTxt += '<input type="hidden" class="option" name="cardtype[]" value="checkcard" />';
      else 
        appendTxt += '<input type="hidden" class="option" name="cardtype[]" value="singlecard" />';

      appendTxt += '<div style="clear: both;"></div>';

      if ($('#f_sound_btn').hasClass('btn-primary')) {
        appendTxt += '<input type="hidden" name="f_sound[]" value="" id="f_sound-' + (card_count + 1) + '" />';

        appendTxt += '<div id="f_sound_previewer-' + (card_count + 1) + '" style="display:none;padding-right:20px;">';
        appendTxt += '  <div id="f_sound_preview-' + (card_count + 1) + '"></div>'; 
        appendTxt += '  <div id="f_sound_delete-' + (card_count + 1) + '">';
        appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '" class="btn btn-default btn-xs delete-asset-front" data-toggle="modal">';
        appendTxt += '    <i class="fa fa-minus"></i> Delete Sound</button>';
        appendTxt += '  </div>';
        appendTxt += '</div>';

        appendTxt += '<div id="f_sound_add-' + (card_count + 1) + '" style="display:block;padding-right:20px;">';
        appendTxt += '  <button type="button" class="btn btn-default btn-xs sound-modal-ajax" id="sound-modal-ajax" data-key="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addSound', array('type'=>'front', 'id'=>'')) }}">';
        appendTxt += '  <i class="fa fa-plus"></i> Add Sound...</button>';
        appendTxt += '</div>';
      } else {
        appendTxt += '<input type="hidden" name="f_sound[]" value="none" id="f_sound-' + (card_count + 1) + '" />';
      }
		
      if ($('#f_image_btn').hasClass('btn-primary')) {

        appendTxt += '<input type="hidden" name="f_image[]" value="" id="f_image-' + (card_count + 1) + '" />';

        appendTxt += '<div id="f_image_previewer-' + (card_count + 1) + '" style="display:none;">';
        appendTxt += '  <div id="f_image_preview-' + (card_count + 1) + '"></div>';                     
        appendTxt += '  <div id="f_image_delete-' + (card_count + 1) + '">';
        appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '" class="btn btn-default btn-xs delete-asset-front" data-toggle="modal">';
        appendTxt += '    <i class="fa fa-minus"></i> Delete Image</button>';
        appendTxt += '  </div>';
        appendTxt += '</div>';

        appendTxt += '<div id="f_image_add-' + (card_count + 1) + '" style="display:block;">';
        appendTxt += '  <button type="button" class="btn btn-default btn-xs image-modal-ajax" id="image-modal-ajax" data-key="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addImage', array('type'=>'front', 'id'=>'')) }}">';
        appendTxt += '  <i class="fa fa-plus"></i> Add Image...</button>';
        appendTxt += '</div>'; 
      } else {
        appendTxt += '<input type="hidden" name="f_image[]" value="none" id="f_image-' + (card_count + 1) + '" />';
      }       

      appendTxt += '</div></div>';

      appendTxt += '<div class="col-md-7">';      
      appendTxt += '<div>';
      if (card_type == "Single Choice" || card_type == "Multi Choice") 
          appendTxt += '<input type="hidden" name="subcard_id-' + (card_count + 1) + '[]" value="0">';
 
      appendTxt += '<span class="text ' + $('#b_text_btn').attr('class') + '">Text</span>';
      appendTxt += '<span class="sound ' + $('#b_sound_btn').attr('class') + '">Sound</span>';
      appendTxt += '<span class="image ' + $('#b_image_btn').attr('class') + '">Image</span>';

      if (card_type == "Single Choice") 
        appendTxt += '<input type="radio" checked="" class="optionbtn" name="option-' + (card_count + 1) + '" value="1" />';

      if (card_type == "Multi Choice") 
        appendTxt += '<input type="checkbox" class="optionbtn" name="check-' + (card_count + 1) + '[]" value="1" />';

      appendTxt += '<a class="btn btn-white delete-card" data-key="0">Delete Card</a>';
      appendTxt += '<a';

      if (card_type == "Fill in Blank")
        appendTxt += ' disabled="disabled"';

      appendTxt += ' class="btn btn-white new-option">New Option</a>';

      if ($('#b_text_btn').hasClass('btn-primary')) {
          appendTxt += '<input type="hidden" value="1" name="b_text_option-' + (card_count + 1) + '[]" />';
      } else {
          appendTxt += '<input type="hidden" value="0" name="b_text_option-' + (card_count + 1) + '[]" />';
      }     

      appendTxt += '<input type="text" name="b_text-' + (card_count + 1) + '[]" />';
      appendTxt += '<div style="clear: both;"></div>';

      if ($('#b_sound_btn').hasClass('btn-primary')) {
        appendTxt += '<input type="hidden" value="" name="b_sound-'+ (card_count + 1) +'[]" id="b_sub_sound-' + (card_count + 1) + '-1" />';

        if ($('#b_image_btn').hasClass('btn-primary')) {
          appendTxt += '<div id="b_sound_previewer-' + (card_count + 1) + '-1" style="display:none;padding-right:20px;">';
        } else {
          appendTxt += '<div id="b_sound_previewer-' + (card_count + 1) + '-1" style="display:none;">';
        }

        appendTxt += '  <div id="b_sound_preview-' + (card_count + 1) + '-1"></div>'; 
        appendTxt += '  <div id="b_sound_delete-' + (card_count + 1) + '-1">';
        appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '-1" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
        appendTxt += '    <i class="fa fa-minus"></i> Delete Sound</button>';
        appendTxt += '  </div>';
        appendTxt += '</div>';

        if ($('#b_image_btn').hasClass('btn-primary')) {
            appendTxt += '<div id="b_sound_add-' + (card_count + 1) + '-1" style="padding-right:20px;">';
        } else {
            appendTxt += '<div id="b_sound_add-' + (card_count + 1) + '-1">';
        }

        appendTxt += '<button type="button" class="btn btn-default btn-xs b-sound-modal-ajax" id="b-sound-modal-ajax-1" data-key="1" ';
        appendTxt += 'data-parent="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addSound', array('type'=>'back', 'id'=>'')) }}">';
        appendTxt += '<i class="fa fa-plus"></i> Add Sound...</button>';
        appendTxt += '</div>';        
      
      } else {
        appendTxt += '<input type="hidden" value="none" name="b_sound-'+ (card_count + 1) +'[]" id="b_sub_sound-' + (card_count + 1) + '-1" />';
      }      

      if ($('#b_image_btn').hasClass('btn-primary')) {
        
        appendTxt += '<input type="hidden" value="" name="b_image-'+ (card_count + 1) +'[]" id="b_sub_image-' + (card_count + 1) + '-1" />';
        appendTxt += '<div id="b_image_previewer-' + (card_count + 1) + '-1" style="display:none;">';
        appendTxt += '  <div id="b_image_preview-' + (card_count + 1) + '-1"></div>';                     
        appendTxt += '  <div id="b_image_delete-' + (card_count + 1) + '-1">';
        appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '-1" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
        appendTxt += '    <i class="fa fa-minus"></i> Delete Image</button>';
        appendTxt += '  </div>';
        appendTxt += '</div>';

        appendTxt += '<div id="b_image_add-' + (card_count + 1) + '-1" style="display:block;">';
        appendTxt += '  <button type="button" class="btn btn-default btn-xs b-image-modal-ajax" id="b-image-modal-ajax-'+ (card_count + 1) +'" data-key="1" ';
        appendTxt += 'data-parent="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addImage', array('type'=>'back', 'id'=>'')) }}">';
        appendTxt += '  <i class="fa fa-plus"></i> Add Image...</button>';
        appendTxt += '</div>';    
      } else {
        appendTxt += '<input type="hidden" value="none" name="b_image-'+ (card_count + 1) +'[]" id="b_sub_image-' + (card_count + 1) + '-1" />';
      }

      appendTxt += '</div>';

      if (card_type == "Single Choice" || card_type == "Multi Choice") {
        appendTxt += '<div>';
        if (card_type == "Single Choice" || card_type == "Multi Choice") 
            appendTxt += '<input type="hidden" name="subcard_id-' + (card_count + 1) + '[]" value="0">';
        appendTxt += '<span class="text ' + $('#b_text_btn').attr('class') + '">Text</span>';
        appendTxt += '<span class="sound ' + $('#b_sound_btn').attr('class') + '">Sound</span>';
        appendTxt += '<span class="image ' + $('#b_image_btn').attr('class') + '">Image</span>';

        if (card_type == "Single Choice")
          appendTxt += '<input type="radio" class="optionbtn" name="option-' + (card_count + 1) + '" value="2" />';

        if (card_type == "Multi Choice") 
          appendTxt += '<input type="checkbox" class="optionbtn" name="check-' + (card_count + 1) + '[]" value="2" />';

        appendTxt += '<a class="btn btn-white delete-card" data-key="0">Delete Card</a>';
        appendTxt += '<a class="btn btn-white new-option" data-key="0">New Option</a>';

        if ($('#b_text_btn').hasClass('btn-primary')) {
            appendTxt += '<input type="hidden" value="1" name="b_text_option-' + (card_count + 1) + '[]" />';
        } else {
            appendTxt += '<input type="hidden" value="0" name="b_text_option-' + (card_count + 1) + '[]" />';
        }  

        appendTxt += '<input type="text" name="b_text-' + (card_count + 1) + '[]" />';
        appendTxt += '<div style="clear: both;"></div>';
        
        if ($('#b_sound_btn').hasClass('btn-primary')) {

          appendTxt += '<input type="hidden" value="" name="b_sound-'+ (card_count + 1) +'[]" id="b_sub_sound-' + (card_count + 1) + '-2" />';

          if ($('#b_image_btn').hasClass('btn-primary')) {
            appendTxt += '<div id="b_sound_previewer-' + (card_count + 1) + '-2" style="display:none;padding-right:20px;">';
          } else {
            appendTxt += '<div id="b_sound_previewer-' + (card_count + 1) + '-2" style="display:none;">';
          }

          appendTxt += '  <div id="b_sound_preview-' + (card_count + 1) + '-2"></div>'; 
          appendTxt += '  <div id="b_sound_delete-' + (card_count + 1) + '-2">';
          appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '-2" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
          appendTxt += '    <i class="fa fa-minus"></i> Delete Sound</button>';
          appendTxt += '  </div>';
          appendTxt += '</div>';

          if ($('#b_image_btn').hasClass('btn-primary')) {
              appendTxt += '<div id="b_sound_add-' + (card_count + 1) + '-2" style="padding-right:20px;">';
          } else {
              appendTxt += '<div id="b_sound_add-' + (card_count + 1) + '-2">';
          }

          appendTxt += '<button type="button" class="btn btn-default btn-xs b-sound-modal-ajax" id="b-sound-modal-ajax-2" data-key="2" ';
          appendTxt += 'data-parent="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addSound', array('type'=>'back', 'id'=>'')) }}">'; 
          appendTxt += '  <i class="fa fa-plus"></i> Add Sound...</button>';
          appendTxt += '</div>';           
        } else {
          appendTxt += '<input type="hidden" value="none" name="b_sound-'+ (card_count + 1) +'[]" id="b_sub_sound-' + (card_count + 1) + '-2" />';
        }
          
        if ($('#b_image_btn').hasClass('btn-primary')) {

          appendTxt += '<input type="hidden" value="" name="b_image-'+ (card_count + 1) +'[]" id="b_sub_image-' + (card_count + 1) + '-2" />';

          appendTxt += '<div id="b_image_previewer-' + (card_count + 1) + '-2" style="display:none;">';
          appendTxt += '  <div id="b_image_preview-' + (card_count + 1) + '-2"></div>';                     
          appendTxt += '  <div id="b_image_delete-' + (card_count + 1) + '-2">';
          appendTxt += '    <button type="button" data-key="' + (card_count + 1) + '-2" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
          appendTxt += '    <i class="fa fa-minus"></i> Delete Image</button>';
          appendTxt += '  </div>';
          appendTxt += '</div>';

          appendTxt += '<div id="b_image_add-' + (card_count + 1) + '-2" style="display:block;">';
          appendTxt += '  <button type="button" class="btn btn-default btn-xs b-image-modal-ajax" id="b-image-modal-ajax-2" data-key="2" ';
          appendTxt += 'data-parent="' + (card_count + 1) + '" data-toggle="modal" data-url="{{URL::route('modals/addImage', array('type'=>'back', 'id'=>'')) }}">'; 
          appendTxt += '  <i class="fa fa-plus"></i> Add Image...</button>';   
          appendTxt += '</div>';
        } else {
          appendTxt += '<input type="hidden" value="none" name="b_image-'+ (card_count + 1) +'[]" id="b_sub_image-' + (card_count + 1) + '-2" />';
        }  

        appendTxt += '</div>';
      }

      appendTxt += '</div></li>';

      $('.cards ul').append(appendTxt);

      $('.cards span').removeClass('btn');

      $('.front .btn').removeClass('btn-primary');
      $('.front .btn').addClass('btn-white');
      $('.back .btn').removeClass('btn-primary');
      $('.back .btn').addClass('btn-white');

      $('.card-info .dropdown-toggle').text(' Type of Card ');
      $('.card-info .dropdown-toggle').append('<span class="caret"></span>');

      UIExtendedModals.init(); 
      //FileUploadModals.init();
    } else {
      alert('Select one of Text, Sound or Image in Front and Back side.');
    }    
  });

  $('.cards').on('click', '.new-option', function() {   
    var card_pk = $(this).attr('data-key');

    if (card_type == "" && card_pk > 0) {
      card_type = jQuery('#card_type-' + card_pk).val();
    }
    

    if (!($(this).is("button")) && $(this).hasClass('btn-white')) {
      $(this).addClass('btn-white');
      $(this).removeClass('btn-primary');
    } else {
      $(this).removeClass('btn-primary');
      $(this).addClass('btn-white');
    }
    
    var id = $(this).closest('li').attr('id').substring(4);

    var length = $(this).closest('.col-md-7').children().length;

    $(this).closest('.col-md-7').find('.delete-card').text('Delete Line');

    var appendTxt = '<div>';
    if (card_type == "Single Choice" || card_type == "Multi Choice") 
        appendTxt += '<input type="hidden" name="subcard_id-' + id + '[]" value="0">';
    appendTxt += '<span class="' + $(this).parent().find('.text').attr('class') + '">Text</span>';
    appendTxt += '<span class="' + $(this).parent().find('.sound').attr('class') + '">Sound</span>';
    appendTxt += '<span class="' + $(this).parent().find('.image').attr('class') + '">Image</span>';

    if ($(this).closest('li').find('.col-md-5').find('.option').val() == 'radiocard')
      appendTxt += '<input type="radio" class="optionbtn" name="option-' + id + '" value="' + (length + 1) + '" />';

    if ($(this).closest('li').find('.col-md-5').find('.option').val() == 'checkcard')
      appendTxt += '<input type="checkbox" class="optionbtn" name="check-' + id + '[]" value="' + (length + 1) + '" />';

    appendTxt += '<a class="btn btn-white delete-card" data-key="0">Delete Line</a>';
    appendTxt += '<a class="btn btn-white new-option" data-key="0">New Option</a>';

    var text_class = $(this).parent().find('.text').attr('class').substring(5);    
    var sound_class = $(this).parent().find('.sound').attr('class').substring(6);
    var image_class = $(this).parent().find('.image').attr('class').substring(6);

    
    if ($.trim(text_class) == 'btn-primary') {
        appendTxt += '<input type="hidden" value="1" name="b_text_option-' + id + '[]" />';
    } else {
        appendTxt += '<input type="hidden" value="0" name="b_text_option-' + id + '[]" />';
    } 

    appendTxt += '<input type="text" name="b_text-' + id + '[]" /><div style="clear: both;"></div>';   

      
    if ($.trim(sound_class) == "btn-primary") {
      appendTxt += '<input type="hidden" value="" name="b_sound-' + id + '[]" id="b_sub_sound-' + id + '-' + (length + 1) + '" />';
	 
      if (image_class == 'btn-primary') {
        appendTxt += '<div id="b_sound_previewer-' + id + '-' + (length + 1) + '" style="display:none;padding-right:20px;">';
      } else {
        appendTxt += '<div id="b_sound_previewer-' + id + '-' + (length + 1) + '" style="display:none;">';
      }

      appendTxt += '  <div id="b_sound_preview-' + id + '-' + (length + 1) + '"></div>'; 
      appendTxt += '  <div id="b_sound_delete-' + id + '-' + (length + 1) + '">';
      appendTxt += '    <button type="button" data-key="'  + id + '-' +  (length + 1) + '" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
      appendTxt += '    <i class="fa fa-minus"></i> Delete Sound</button>';
      appendTxt += '  </div>';
      appendTxt += '</div>';

      if (image_class == 'btn-primary') {
          appendTxt += '<div id="b_sound_add-' + id + '-' + (length + 1) + '" style="padding-right:20px;">';
      } else {
          appendTxt += '<div id="b_sound_add-' + id + '-' + (length + 1) + '">';
      }            
     
      appendTxt += '<button type="button" class="btn btn-default btn-xs b-sound-modal-ajax" id="b-sound-modal-ajax-'+ (length + 1) +'" data-key="' + (length + 1) + '" ';
      appendTxt += 'data-parent="' + id + '" data-toggle="modal" data-url="{{URL::route('modals/addSound', array('type'=>'back', 'id'=>'')) }}">';  
      appendTxt += '<i class="fa fa-plus"></i> Add Sound...</button>';
      appendTxt += '</div>';
    } else {
      appendTxt += '<input type="hidden" value="none" name="b_sound-' + id + '[]" id="b_sub_sound-' + id + '-' + (length + 1) + '" />';
    } 

    if ($.trim(image_class) == 'btn-primary') {
      appendTxt += '<input type="hidden" value="" name="b_image-' + id + '[]" id="b_sub_image-' + id + '-' + (length + 1) + '" />';

      appendTxt += '<div id="b_image_previewer-' + id + '-' + (length + 1) + '" style="display:none;">';
      appendTxt += '  <div id="b_image_preview-' + id + '-' + (length + 1) + '"></div>';                     
      appendTxt += '  <div id="b_image_delete-' + id + '-' + (length + 1) + '">';
      appendTxt += '    <button type="button" data-key="'  + id + '-' +  (length + 1) + '" class="btn btn-default btn-xs delete-asset-back" data-toggle="modal">';
      appendTxt += '    <i class="fa fa-minus"></i> Delete Image</button>';
      appendTxt += '  </div>';
      appendTxt += '</div>';

      appendTxt += '<div id="b_image_add-' + id + '-' + (length + 1) + '" style="display:block;">';  
      appendTxt += '  <button type="button" class="btn btn-default btn-xs b-image-modal-ajax" id="b-image-modal-ajax-'+ (length + 1) +'" data-key="' + (length + 1) + '" ';
      appendTxt += 'data-parent="' + id + '" data-toggle="modal" data-url="{{URL::route('modals/addImage', array('type'=>'back', 'id'=>'')) }}">';
      appendTxt += '  <i class="fa fa-plus"></i> Add Image...</button>';   
      appendTxt += '</div>';      
    } else {
      appendTxt += '<input type="hidden" value="none" name="b_image-' + id + '[]" id="b_sub_image-' + id + '-' + (length + 1) + '" />';
    }
 
    appendTxt += '</div>';

    $(this).closest('.col-md-7').append(appendTxt);
    
    UIExtendedModals.init(); 
  });

  $('.cards').on('click', '.delete-asset-front', function() {
    var delete_option = $(this).text();
    var data_key = "";
    var data_src = "";

    if ($.trim(delete_option) == "Delete Sound") {
        data_key = $(this).attr("data-key");
        data_src = $('#f_audio-' + data_key).attr('src');
        jQuery('#assetType').val("img");

        $('#f_sound_previewer-' + data_key).css("display", "none");
        $('#f_sound_previewe-' + data_key).html("");
        $('#f_sound_add-' + data_key).css("display", "block");
    } else if ($.trim(delete_option) == "Delete Image") {
        data_key = $(this).attr("data-key");
        data_src = $('#f_img-' + data_key).attr('src');
        jQuery('#assetType').val("img");

        $('#f_image_previewer-' + data_key).css("display", "none");
        $('#f_image_previewe-' + data_key).html("");
        $('#f_image_add-' + data_key).css("display", "block");        
    }

    if (data_src != "") {
        var pathArray = data_src.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var url = protocol + '//' + host;
        var real_path = data_src.replace(url, "");
        
        jQuery('#assetFile').val(real_path);
        $( '#assetDelete' ).ajaxForm(options).submit();    
        //$( '#assetDelete' ).submit();    
    }

  });

  $('.cards').on('click', '.delete-asset-back', function() {
    var delete_option = $(this).text();
    var data_key = "";
    var data_src = "";

    if ($.trim(delete_option) == "Delete Sound") {
        data_key = $(this).attr("data-key");

        data_src = $('#b_audio-' + data_key).attr('src');
        jQuery('#assetType').val("audio");

        $('#b_sound_previewer-' + data_key).css("display", "none");
        $('#b_sound_previewe-' + data_key).html("");
        $('#b_sound_add-' + data_key).css("display", "block");

    } else if ($.trim(delete_option) == "Delete Image") {
        data_key = $(this).attr("data-key");

        data_src = $('#b_img-' + data_key).attr('src');
        jQuery('#assetType').val("img");

        $('#b_image_previewer-' + data_key).css("display", "none");
        $('#b_image_previewe-' + data_key).html("");
        $('#b_image_add-' + data_key).css("display", "block");
    }

    if (data_src != "") {
        var pathArray = data_src.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var url = protocol + '//' + host;
        var real_path = data_src.replace(url, "");
        
        jQuery('#assetFile').val(real_path);
        $( '#assetDelete' ).ajaxForm(options).submit();    
        //$( '#assetDelete' ).submit();    
    }
  });

  // Delete row in a table
  var options = {
    success:  showResponse,
    dataType: 'json' 
  };

  function showResponse(response, statusText, xhr, $form)  {
    
    if (response.status == true) {
        
    } else {
        
    }
  }

  $('.cards').on('click', '.delete-card', function() {
    if (!($(this).is("button")) && $(this).hasClass('btn-white')) {
      $(this).addClass('btn-white');
      $(this).removeClass('btn-primary');
    } else {
      $(this).removeClass('btn-primary');
      $(this).addClass('btn-white');
    }

    var delete_option = $(this).text();
    var card_pk = $(this).attr('data-key');

    if (card_pk > 0) {

    }

    if (delete_option == "Delete Card") {
      var rowObj = $(this).closest('li');
      $.confirm({
        'title'   : 'Delete Confirmation',
        'message' : 'Do you really want to delete selected card?',
        'buttons' : {
          'Yes' : {
            'class' : 'blue',
            'action': function(){   
                rowObj.prev().remove();
                rowObj.remove();
                $('.cards ul li').removeClass('even')
                var i = 0;
                $('.cards ul li').each(function() {
                  if (i % 2 == 1)
                    $(this).addClass('even');
                  i++;
                });
            }
          },
          'No'  : {
            'class' : 'gray',
            'action': function(){}  // Nothing to do in this case. You can as well omit the action property.
          }
        }
      }); 


    }

    if (delete_option == "Delete Line") {
      var object = $(this).closest('.col-md-7');
      var count = object.children().length;

      if (count == 3)
        $(this).closest('.col-md-7').find('.delete-card').text('Delete Card');

      $(this).parent().remove();

      var i = 1;
      object.children().each(function() {
        $(this).find('.optionbtn').val(i++);
      });
    }
  });
});

  var FormValidationWithCourse = function () {

    var handleValidation1 = function() {
      // for more info visit the official plugin documentation: 
      var form1 = $('#sprintAdd');
      var error1 = $('.alert-danger', form1);
      //var success1 = $('.alert-success', form1);
      form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {     
                courses: {
                    required: true
                },          
                name: {
                    minlength: 1,
                    required: true
                },
                description: {
                    minlength: 1,
                    required: true
                },
                fluency: {
                    minlength: 1,
                    required: true
                }
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
            $('#courses option:selected').each(function(){      
              $course = $(this).val();
              $('#course').val($course);
            });

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

   var FormValidationWithoutCourse = function () {

    var handleValidation1 = function() {
      // for more info visit the official plugin documentation: 
      var form1 = $('#sprintAdd');
      var error1 = $('.alert-danger', form1);
      //var success1 = $('.alert-success', form1);
      form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {                
                name: {
                    minlength: 1,
                    required: true
                },
                description: {
                    minlength: 1,
                    required: true
                },
                fluency: {
                    minlength: 1,
                    required: true
                }
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