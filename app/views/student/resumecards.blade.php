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
    <!-- headerbar -->   
    <div class="contentpanel">
      <div class="row">
        <input type="hidden" id="response_time" value="{{$setting['response_time']}}">
        <input type="hidden" id="loops" value="{{$setting['loops']}}">
        <input type="hidden" id="active" value="{{$setting['active']}}">

        {{Form::open(array('url' => 'student_quizcomplete', 'id' => 'quizform', 'method' => 'post'))}}
        <div class="control-panel col-md-1">
          <input type="hidden" name="progress_id" id="progress_id" value="{{$progress_id}}">
          <input type="hidden" name="id" id="sprint" value="{{$sprint_id}}">
          <input type="hidden" name="school" id="school" value="{{$school_id}}">
          <input type="hidden" name="response_time" value="{{$setting['response_time']}}">
          <input type="hidden" id="total_time" name="total_time" value="">
          <input type="hidden" id="mastered" name="mastered" value="">
          <input type="hidden" name="user" id="user" value="{{$user->id}}">
          <input type="hidden" id="total_cards" name="total_cards" value="">
          <input type="hidden" id="rate" name="rate" value="{{$rate}}">
          <input type="hidden" id="break" name="break" value="">
          <input type="hidden" id="interval" name="interval" value="{{$user->interval}}">
          <label class="total-label">Total Cards</label>
          <span id="total-count">
            <b>{{$total_count}}</b>
          </span>
          <label class="total-label">Mastered Cards</label>
          <span id="mastered-count">
            <b>{{$mastered_count}}</b>
          </span>
          <label class="total-label">Trials</label>
          <span id="proceed-count">
            <b>0</b>
          </span>
          <input type="hidden" id="correct_cards" name="correct_cards" value="">
          <label class="cor-label">Correct</label>
          <span id="correct-count">
            <b>0</b>
          </span>
          <input type="hidden" id="incorrect_cards" name="incorrect_cards" value="">
          <label class="inc-label">Incorrect</label>
          <span id="incorrect-count">
            <b>0</b>
          </span>
          <!--
            <button type="button" class="btn btn-success finish">Start</button>
          -->
        </div><!-- control-panel -->
        {{Form::close()}}

        <div class="play-area">
          <?php $i = 1; ?>
          @foreach($cards as $card)
            <div id="play-{{$i++}}">
              <audio class="player" src="{{$card->f_sound_path}}{{$card->f_sound}}"></audio>
            </div>
          @endforeach
        </div>

        @if (sizeof($cards) > 1)
          <?php $i = 0; ?>
          <div class="hidden-cards">
            @foreach($cards as $card)
            <div class="show-{{$i}}">
              <div class="card-number">Show Card {{$i + 1}}</div>
              <div class="front card-table {{$card->card_type}}">
                <div class="listen">
                  @if ($card->f_sound_option == 1)
                    <span class="fa fa-volume-up"></span><br />
                  @else
                    <span class="no-sound">&nbsp;</span><br />
                  @endif
                  @if ($card->f_text_option == 1)
                    <span class="fa">{{$card->f_text}}</span><br />
                  @endif
                  <div class="interval_bar">
                    <div class="real_bar"></div>
                  </div>
                </div>
                <div class="prompt">
                  @if ($card->card_type == "singlecard")
                    <input type="text" class="answer">
                    <input type="button" class="answer-button singlecard" value="Answer" />
                    <div class="show-answer">Correct Answer</div>
                    <input type="text" class="correct" value="{{$card->b_text}}" disabled />
                  @elseif ($card->card_type == "radiocard")
                    <ul>
                    @foreach ($subcards as $subcard)
                      @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                        <div class="show-answer">Correct Answer</div>
                      @endif
                      @if ($subcard->cards == $card->id)
                        <li>                          
                          <div class="rdio rdio-default">
                            <input type="radio" name="sub-{{$i}}" id="radio_{{$subcard->id}}_{{$i}}" value="{{$subcard->answer}}" />
                            <label for="radio_{{$subcard->id}}_{{$i}}">{{$subcard->answer}}</label>
                          </div>
                        </li>
                      @endif
                    @endforeach
                    </ul>
                    <!--<input type="hidden" name="option-{{$i}}" class="cardoption" id="option-{{$i}}">-->
                    <input type="hidden" name="option-{{$i}}" class="cardoption">
                    <input type="button" class="answer-button radiocard" value="Answer" />
                  @elseif ($card->card_type == "checkcard")
                    <ul>
                    @foreach ($subcards as $subcard)
                      @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                        <div class="show-answer">Correct Answer</div>
                      @endif
                      @if ($subcard->cards == $card->id)
                        <li>
                          <input id="check-{{$subcard->id}}" value="{{$subcard->answer}}" type="checkbox">
                          <label for="check-{{$subcard->id}}">{{$subcard->answer}}</label>
                        </li>
                      @endif
                    @endforeach
                    </ul>
                  @endif
                </div>
              </div>
              <div class="back card-table">
                @if ($card->card_type == "singlecard")
                  @if ($card->b_text_option == 1)
                    <span class="fa">{{$card->b_text}}</span>
                  @endif
                @elseif ($card->card_type == "radiocard" || $card->card_type == "checkcard")
                  @foreach ($subcards as $subcard)
                    @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                      @if ($subcard->b_text_option == 1)
                        <span class="fa">{{$subcard->answer}}</span>
                      @endif
                      @if ($card->card_type == "checkcard")
                        <span class="fa">,</span>
                      @endif
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
            <div class="test-{{$i}}">
              <input type="hidden" class="real-id" value="{{$card->id}}" />
              <div class="card-number">Test Card {{$i + 1}}</div>
              <div class="front card-table {{$card->card_type}}">
                <div class="listen">
                  @if ($card->f_sound_option == 1)
                    <span class="fa fa-volume-up"></span><br />
                  @else
                    <span class="no-sound">&nbsp;</span><br />
                  @endif
                  @if ($card->f_text_option == 1)
                    <span class="fa">{{$card->f_text}}</span><br />
                  @endif
                  <div class="interval_bar">
                    <div class="real_bar"></div>
                  </div>
                </div>
                <div class="prompt">
                  @if ($card->card_type == "singlecard")
                    <input type="text" class="answer">
                    <input type="button" class="answer-button singlecard" value="Answer" />
                    <div class="show-answer">Correct Answer</div>
                    <input type="text" class="correct" value="{{$card->b_text}}" disabled />
                  @elseif ($card->card_type == "radiocard")
                    <ul>
                    @foreach ($subcards as $subcard)
                      @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                        <div class="show-answer">Correct Answer</div>
                      @endif
                      @if ($subcard->cards == $card->id)
                        <li>
                          <div class="rdio rdio-default">
                            <input type="radio" name="sub-{{$i}}" id="radio_{{$subcard->id}}_{{$i}}" value="{{$subcard->answer}}" />
                            <label for="radio_{{$subcard->id}}_{{$i}}">{{$subcard->answer}}</label>
                          </div>
                        </li>
                      @endif
                    @endforeach
                    </ul>
                    <!--<input type="hidden" name="option-{{$i}}" class="cardoption" id="option-{{$i}}">-->
                    <input type="hidden" name="option-{{$i}}" class="cardoption">
                    <input type="button" class="answer-button radiocard" value="Answer" />
                  @elseif ($card->card_type == "checkcard")
                    <ul>
                    @foreach ($subcards as $subcard)
                      @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                        <div class="show-answer">Correct Answer</div>
                      @endif
                      @if ($subcard->cards == $card->id)
                        <li>
                          <input id="check-{{$subcard->id}}" value="{{$subcard->answer}}" type="checkbox">
                          <label for="check-{{$subcard->id}}">{{$subcard->answer}}</label>
                        </li>
                      @endif
                    @endforeach
                    </ul>
                    <input type="button" class="answer-button checkcard" value="Answer" />
                  @endif
                </div>
              </div>
              <div class="back card-table">
                @if ($card->card_type == "singlecard")
                  @if ($card->b_text_option == 1)
                    <span class="fa">{{$card->b_text}}</span>
                  @endif
                @elseif ($card->card_type == "radiocard" || $card->card_type == "checkcard")
                  @foreach ($subcards as $subcard)
                    @if ($subcard->cards == $card->id && $subcard->correctanswer == 1)
                      @if ($subcard->b_text_option == 1)
                        <span class="fa">{{$subcard->answer}}</span>
                      @endif
                      @if ($card->card_type == "checkcard")
                        <span class="fa">,</span>
                      @endif
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
            <?php $i++; ?>
            @endforeach
          </div><!-- hidden other cards -->
        @endif

        <div class="flow-cards col-md-6">
          <div class="card-0 current">
            <input type="hidden" class="real-id" value="{{$cards[$last_index]->id}}" />
            <div class="card-number">Test Card {{$last_index + 1}}</div>
            <div class="front card-table {{$cards[$last_index]->card_type}}">
              <div class="listen">
                @if ($cards[$last_index]->f_sound_option == 1)
                  <span class="fa fa-volume-up"></span><br />
                @else
                  <span class="no-sound">&nbsp;</span><br />
                @endif
                @if ($cards[$last_index]->f_text_option == 1)
                  <span class="fa">{{$cards[$last_index]->f_text}}</span><br />
                @endif
                <div class="interval_bar">
                  <div class="real_bar"></div>
                </div>
              </div>
              <div class="prompt">
                @if ($cards[$last_index]->card_type == "singlecard")
                  <input type="text" class="answer">
                  <input type="button" class="answer-button singlecard" value="Answer" />
                  <div class="show-answer">Correct Answer</div>
                  <input type="text" class="correct" value="{{$cards[$last_index]->b_text}}" disabled />
                @elseif ($cards[$last_index]->card_type == "radiocard")
                  <ul>
                  @foreach ($subcards as $subcard)
                    @if ($subcard->cards == $cards[$last_index]->id && $subcard->correctanswer == 1)
                      <div class="show-answer">Correct Answer</div>
                    @endif
                    @if ($subcard->cards == $cards[$last_index]->id)
                      <li>
                        <div class="rdio rdio-default">
                          <input type="radio" name="sub-0" id="radio_{{$subcard->id}}_0" value="{{$subcard->answer}}" />
                          <label for="radio_{{$subcard->id}}_0">{{$subcard->answer}}</label>
                        </div>
                      </li>
                    @endif
                  @endforeach
                  </ul>
                  <!--<input type="hidden" name="option-{{$last_index}}" class="cardoption" id="option-{{$last_index}}">-->
                  <input type="hidden" name="option-{{$last_index}}" class="cardoption">
                  <input type="button" class="answer-button radiocard" value="Answer" />
                @elseif ($cards[$last_index]->card_type == "checkcard")
                  <ul>
                  @foreach ($subcards as $subcard)
                    @if ($subcard->cards == $cards[$last_index]->id && $subcard->correctanswer == 1)
                      <div class="show-answer">Correct Answer</div>
                    @endif
                    @if ($subcard->cards == $cards[$last_index]->id)
                      <li>
                        <input id="check-{{$subcard->id}}" value="{{$subcard->answer}}" type="checkbox">
                        <label for="check-{{$subcard->id}}">{{$subcard->answer}}</label>
                      </li>
                    @endif
                  @endforeach
                  </ul>
                  <input type="button" class="answer-button checkcard" value="Answer" />
                @endif
              </div>
            </div>
            <div class="back card-table">
              @if ($cards[$last_index]->card_type == "singlecard")
                @if ($cards[$last_index]->b_text_option == 1)
                  <span class="fa">{{$cards[$last_index]->b_text}}</span>
                @endif
              @elseif ($cards[$last_index]->card_type == "radiocard" || $cards[$last_index]->card_type == "checkcard")
                @foreach ($subcards as $subcard)
                  @if ($subcard->cards == $cards[$last_index]->id && $subcard->correctanswer == 1)
                    @if ($subcard->b_text_option == 1)
                      <span class="fa">{{$subcard->answer}}</span>
                    @endif
                    @if ($cards[$last_index]->card_type == "checkcard")
                      <span class="fa">,</span>
                    @endif
                  @endif
                @endforeach
              @endif
            </div>
          </div>
      	</div><!-- flow-cards -->
      </div><!-- row -->
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->
  
@endsection

@section('pageLevelPlugins')
{{HTML::script('assets/js/retina.min.js')}}
{{HTML::script('assets/js/jquery.cookies.js')}}

{{HTML::script('assets/js/jquery.sparkline.min.js')}}
{{HTML::script('assets/js/toggles.min.js')}}
{{HTML::script('assets/js/jquery.datatables.min.js')}}
{{HTML::script('assets/js/jquery.simpleplayer.js')}}

{{HTML::script('assets/js/custom.js')}}
@endsection

@section('javaScript')

<script type="text/javascript">
  document.onkeydown = function (event) {
    if (!event) {
      event = window.event;
    }
      
    var keyCode = event.keyCode;
    
    if (keyCode == 8 &&
    ((event.target || event.srcElement).tagName != "TEXTAREA") && 
    ((event.target || event.srcElement).tagName != "INPUT")) {
      if (navigator.userAgent.toLowerCase().indexOf("msie") == -1) {
        event.stopPropagation();
      } else {
        event.returnValue = false;
      }
      
      return false;
    }
  };  
</script>

<script>
jQuery(document).ready(function() {
  $(window).resize(function() {
    var card_height = $(window).height() - $('.card-header').height() - $('.card-title').height() - 20;
    card_height = Math.round(card_height * 0.88);

    $('.flow-cards>div').css('height', card_height);
  });
  
  $('.player').player();
  $( '#mainbody' ).addClass('horizontal-menu');

  if (!$('.topnav .nav li:last-child a').hasClass('finish'))
    $('.topnav .nav li:last-child a').addClass('finish');

  var progress_id = $('#progress_id').val();
 
  var correct_count = parseInt($('#correct-count b').text());
  var incorrect_count = parseInt($('#incorrect-count b').text());
  var play_cards = 0;
  var response_time = $('#response_time').val();

  var original_cards = ($('.flow-cards>div').length + $('.hidden-cards>div').length) / 2;

  var mastered = '';

  $('.mainpanel').css('min-height', $(window).height() - $('.headerbar').height());
  $('.mainpanel').css('height', $(window).height() - $('.headerbar').height());

  $('.answer').removeAttr('disabled');
  $('.answer').val('');
  $('.answer-button').removeAttr('disabled');
  $('input[type=radio]').removeAttr('disabled');
  $('input[type=checkbox]').removeAttr('disabled');
  $('input[type=radio]').attr('checked', false);
  $('input[type=checkbox]').attr('checked', false);

  if ($('.front').hasClass('checkcard'))
    $('.back span:last-child').remove();

  var card_height = $(window).height() - $('.card-header').height() - $('.card-title').height() - 20;
  card_height = Math.round(card_height * 0.88);

  $('.flow-cards>div').css('height', card_height);
  
  var times_of_mastered_cards = new Array();
  var card_loops = [];
  var card_add = [];
  var loops = parseInt($('#loops').val());
  var active = parseInt($('#active').val());
  var show_count = active;

  var real_id = [];
  var front_html = [];
  var front_class = [];
  var back_html = [];
  var back_class = [];

  var spend_time = [];
  var int_val = $('#interval').val();
  var int_sum = 0;

  card_loops[0] = loops;

  for (var i = 0; i < ($('.hidden-cards>div').length / 2); i++)
    card_loops[i] = loops;

  var index = [];
  var j = 0;
  var count = active;

  if (($('.hidden-cards>div').length / 2) < active) {
      count = ($('.hidden-cards>div').length / 2);
  }

  for (var i = 0; i < count; i++) {
    if ($('.hidden-cards .test-' + i + ' .real-id').val() == $('.card-0 .real-id').val())
      j = i;
    else
      index.push(i);
  }

  index.push(j);

  $('.player').on('ended', function(evt) {
    $('.card-table .fa').css('color', '#000000');
    $('.card-table .fa-volume-up').css('color', '#C0B8AB');
  });

  $('.player').on('timeupdate', function(e) {
    $('.card-table .fa').css('color', '#1F6FD9');
  });

  setTimeout(function() {
    $('#play-' + (j + 1)).find('.simpleplayer-play-control').click();
    $('.current .answer').focus();
  }, 1000);

  var timeout = 0;
  var totaltime = 0;
  var myInterval = 0;
  var count = 0;
  var wait_time = 500;
  var sound_time = 300;

  var prev_correct_count = 0;
  var prev_incorrect_count = 0;

  $('.current .answer').focus();
    
  function onNextSlider(times) {
    if ($('.flow-cards>div').length != count++) {
      if (!$('.current .back').prev().find('.answer-button').hasClass('clicked')) {
        $('.current .back').prev().find('.answer-button').click();       
      }

      $('.flow-cards>div').css('height', card_height);

      if ($('.current .front').hasClass('singlecard')) {
        if (!$('.current .front .prompt .answer').hasClass('corrected'))
          times += 1500;
      }

      if ($('.current .front').hasClass('radiocard')) {
        $('.current .front .prompt ul li').each(function() {
          if ($(this).find('.rdio').hasClass('rdio-danger'))
            times += 1500;
        });
      }

      setTimeout(function() {
        timeout = 0;
        myInterval = setInterval(function () {
          ++timeout;
        }, 100);

        var id = count;

        if ($('.flow-cards>div').length > id) {

          var real_height = card_height * (-1) * id - 20 * (id - 1);
          $('.card-0').css('margin-top', real_height);

          $('.flow-cards>div').removeClass('current');
          $('.card-' + id).addClass('current');

          $('.current .real_bar').css('width', $('.current').prev().find('.real_bar').css('width'));
          $('.current .real_bar').css('background-color', $('.current').prev().find('.real_bar').css('background-color'));

          setTimeout(function() {
            var test_id = $('.current .card-number').text();
            test_id = test_id.substring(10, test_id.length);
            $('#play-' + test_id).find('.simpleplayer-play-control').click();
            $('.current .answer').focus();
          }, sound_time);
        }
      }, times);
      cardPlay = setInterval(onCardSlider, response_time * 1000 + 2500);
    }
  }

  onCardSlider = function () {
      if ($('.flow-cards>div').length == count++)
        clearInterval(cardPlay);

      if (!$('.current .back').prev().find('.answer-button').hasClass('clicked'))
        $('.current .back').prev().find('.answer-button').click();       

      $('.flow-cards>div').css('height', card_height);
      
      setTimeout(function() {
        timeout = 0;
        myInterval = setInterval(function () {
          ++timeout;
        }, 100);

        var id = count;
        if ($('.flow-cards>div').length > id) {
          var real_height = card_height * (-1) * id - 20 * (id - 1);
          $('.card-0').css('margin-top', real_height);

          $('.flow-cards>div').removeClass('current');
          $('.card-' + id).addClass('current');

          $('.current .real_bar').css('width', $('.current').prev().find('.real_bar').css('width'));
          $('.current .real_bar').css('background-color', $('.current').prev().find('.real_bar').css('background-color'));

          setTimeout(function() {
            var test_id = $('.current .card-number').text();
            test_id = test_id.substring(10, test_id.length);
            $('#play-' + test_id).find('.simpleplayer-play-control').click();
            $('.current .answer').focus();
          }, sound_time);
        }
      }, wait_time + 2000);
  };

  var cardPlay = setInterval(onCardSlider, response_time * 1000 + 2500);

  $('.card-title a').click(function() {
    $('#form').submit();
  });

  $('.flow-cards').on('click', '.fa', function() {
    var test_id = $('.current .card-number').text();
    test_id = test_id.substring(10, test_id.length);
    $('#play-' + test_id).find('.simpleplayer-play-control').click();
  });

  $('.answer-button').click(function() {
      $('.flow-cards>div').css('height', card_height);      
      answerfunc($(this));
  });

  function setTransaction(card_no, is_corrected, no_answer, response_time) {
    var school = $('#school').val();
    var sprint = $('#sprint').val();
    var student = $('#user').val();

    var trans = new Object();
    trans.student = student;
    trans.school = school;
    trans.sprint = sprint;
    trans.card_no = card_no;
    trans.is_corrected = is_corrected;
    trans.no_answer = no_answer;

    int_sum += (response_time + 2.5);

    if (int_sum > int_val) {
      $('.current .real_bar').css('width', '100%');
      $('.current .real_bar').css('border-radius', '10px');
      $('#break').val("break");
      $('.finish').click();
    } else {
      $('.current .real_bar').css('width', int_sum / int_val * 100 + '%');
    }

    if (card_no != undefined && card_no > 0 && response_time > 0) {
      var url = "../student/transaction/" + student + "/" + school + "/" + 
        sprint + "/" + card_no  + "/" + is_corrected  + "/" + no_answer  + "/" + response_time + "/" + Math.random();
      
      $.ajax({
          type: "GET",
          url : url,

          success : function(data){
            
           },
          error : function(error){
            
          }   
      }, "json");
    }
  }

  function answerfunc(elem) {

    clearInterval(myInterval);
    timeout = timeout / 10;
    totaltime += timeout;

    var card_arr = [];
    var time_value = [];
    var card_flag = false;
    var test_id = $('.current .card-number').text();
    

    test_id = test_id.substring(10, test_id.length);
    test_id--;     

    real_id[test_id] = $('.current .real-id').val();
    //console.log(real_id[test_id] + "***" + test_id);  
    front_html[test_id] = $('.current .front').html();
    front_class[test_id] = $('.current .front').attr('class');
    back_html[test_id] = $('.current .back').html();
    back_class[test_id] = $('.current .back').attr('class');
    
    var show_flag = $('.flow-cards .current').hasClass('show');

    var card_id = $.trim($('.flow-cards .current').attr('class').replace('current', ''));

    var id = parseInt($.trim(card_id.replace('show', '').replace('card-', '')));
    id++;
    spend_time[id] = timeout;
    var bar_color = 0;
    var real_color = '';

    if (id < 4)
      bar_color = timeout;
    else
      bar_color = (spend_time[id] + spend_time[id - 1]) / (spend_time[id - 2] + spend_time[id - 3] + 0.1);

    if (bar_color < 1.5) {
      x = 0xFF;
      y = 0x00;
      s = (x - y) / 15;      
      hex_color = parseInt(x - bar_color * s * 10).toString(16).toUpperCase();
      real_color = '#12' + hex_color + '2D';
    } else if (bar_color > 1.5 && bar_color <= 2.5) {
      x = 0xFF;
      y = 0x3D;
      s = (x - y) / 10;
      hex_color = parseInt(x - (bar_color - 1.5) * s * 10).toString(16).toUpperCase();
      real_color = '#0000' + hex_color;
    } else {
      real_color = '#00003D'; 
    }

    $('.current .real_bar').css('background-color', real_color);

    if (!show_flag) {
      play_cards++;
      $('#proceed-count b').text(play_cards.toString());
    }

    elem.addClass('clicked');
    elem.attr('disabled', 'disabled');
    var real_card_no = real_id[test_id];
    var is_empty = 1;

    if (elem.hasClass('singlecard')) {
      var answer = elem.prev().val();
      var correct = $.trim(elem.parent().find('.correct').val());

      elem.parent().find('.answer').attr("disabled", "disabled");

      if (correct == answer) {
        card_flag = true;
        setTransaction(real_card_no, 1, is_empty, timeout);
        elem.parent().find('.answer').addClass('corrected');

        var green = 100 + Math.round(155 * (1 - timeout / response_time));
        var color = "#00" + ("0" + parseInt(green, 10).toString(16)).slice(-2) + "00";
        
        elem.parent().find('.answer').css('border-color', color);
      } else {        
        if (answer.length <= 0) {
            is_empty = 0;
        }
        setTransaction(real_card_no, 0, is_empty, timeout);
        elem.parent().find('.show-answer').show();
        elem.parent().find('.correct').show();

        if (answer != '') {
          elem.parent().find('.answer').addClass('incorrected');
        }
      }
    } else if (elem.hasClass('radiocard')) {
      var correct = $.trim($('.current .back .fa').text());
      var answer = elem.parent().find('.cardoption').val();

      elem.parent().find('input[type=radio]').each(function() {
        $(this).attr('disabled', true);
      });

      if (correct == answer) {

        card_flag = true;
        
        setTransaction(real_card_no, 1, is_empty, timeout);
        elem.parent().find('input[type=radio]').each(function() {
          if ($(this).val() == answer) {
            $(this).parent().addClass('rdio rdio-success');
          }
        });
      } else {
        if (answer.length <= 0) {
            is_empty = 0;
        }
        setTransaction(real_card_no, 0, is_empty, timeout);
        elem.parent().find('.show-answer').show();
        if (answer != '') {
          elem.parent().find('input[type=radio]').each(function() {
            if ($(this).val() == answer) {
              $(this).parent().addClass('rdio rdio-danger');
            }
          });
        }
      }
    } else if (elem.hasClass('checkcard')) {
      var correct = [];
      $('.current .back').find('span:nth-child(odd)').each(function() {
        correct.push($(this).text());
      });

      var isCorrect = true;
      var checked_count = 0;
      elem.prev().find('input[type=checkbox]').each(function() {
        $(this).attr('disabled', true);
        if (isCorrect == true) {
          if ($(this).is(':checked') && $.inArray($(this).val(), correct) < 0)
            isCorrect = false;
          if (!$(this).is(':checked') && $.inArray($(this).val(), correct) >= 0)
            isCorrect = false;
        }

        if ($(this).is(':checked')) {
          checked_count ++;
          if ($.inArray($(this).val(), correct) < 0) {
            $(this).addClass('incorrected');
          } else {     

            $(this).addClass('corrected');
          }
        } else {
          if ($.inArray($(this).val(), correct) >= 0) {
            $(this).addClass('incorrected');
          }
        }
      });

      if (isCorrect) {
        card_flag = true;
        setTransaction(real_card_no, 1, 1, timeout);
      } else {
        elem.parent().find('.show-answer').show();
        if (checked_count == 0) {
            is_empty = 0;
        } else {
          is_empty = 1;
        }
        setTransaction(real_card_no, 0, is_empty, timeout);        
      }
    }

    var card_no = $('.flow-cards>div').length - 1;

    if (!show_flag) {
      if (card_flag) {
        correct_count++;

        card_arr[loops - card_loops[test_id]] = timeout;
        if (times_of_mastered_cards[test_id] == undefined)
          times_of_mastered_cards[test_id] = new Array();
        times_of_mastered_cards[test_id].push( timeout );

        card_loops[test_id]--;
        card_add.push(test_id);
        card_add = $.unique(card_add);

        if (correct_count <= Math.min(active, $('.hidden-cards>div').length / 2)) {
          card_no++;
          
          appendTxt = '<div class="card-' + card_no + '">';
          appendTxt += $('.hidden-cards .test-' + index[correct_count - 1]).html();
          appendTxt += '</div>';

          $('.flow-cards').append(appendTxt);
          appendFunc(card_no);
        } else {

          if (card_loops[test_id] == 0) {
              var times = times_of_mastered_cards[test_id];
              var max_response_time = Math.max.apply(Math, times); 
              var rate = $('#rate').val();
             
              times_of_mastered_cards[test_id] = new Array();             
              if (max_response_time > 60 / rate) {    
                card_loops[test_id] = loops;
              }               
          }
          
          if (card_loops[test_id] == 0) {

            if (mastered.indexOf($('.current .real-id').val()) == -1) {
              mastered += ($('.current .real-id').val() + ',');

              var url = "../student/progress/" + progress_id + "/" +
                  $('#user').val() + "/" + $('#school').val() + "/" + $('#sprint').val() + "/" + 
                  correct_count + "/" + incorrect_count + "/" + play_cards + "/" +
                  mastered.substring(0, mastered.length - 1) + "/" + totaltime + "/" +
                  Math.random();
              
              $.ajax({
                  type: "GET",
                  url : url,

                  success : function(data){
                    
                   },
                  error : function(error){
                    
                  }   
              }, "json");
              
              $('#mastered-count b').text((parseInt($('#mastered-count b').text()) + 1).toString());

              card_add = jQuery.grep(card_add, function(value) {
                return value != test_id;
              });
              console.log(show_count + "===" + $('.hidden-cards>div').length / 2);
              if (show_count < $('.hidden-cards>div').length / 2) {
                console.log("Next Card=" + card_no);
                card_no ++;
                var appendTxt = '<div class="show card-' + card_no + '">';
                appendTxt += $('.hidden-cards .show-' + show_count).html();
                appendTxt += '</div>';

                $('.flow-cards').append(appendTxt);

                appendFunc(card_no);

                card_no++;
                appendTxt = '<div class="card-' + card_no + '">';
                appendTxt += $('.hidden-cards .test-' + show_count).html();
                appendTxt += '</div>';

                $('.flow-cards').append(appendTxt);

                appendFunc(card_no);

                real_id[show_count] = $('.hidden-cards .test-' + show_count + ' .real-id').val();
                front_class[show_count] = $('.hidden-cards .test-' + show_count + ' .front').attr('class');
                front_html[show_count] = $('.hidden-cards .test-' + show_count + ' .front').html();
                back_class[show_count] = $('.hidden-cards .test-' + show_count + ' .back').attr('class');
                back_html[show_count] = $('.hidden-cards .test-' + show_count + ' .back').html();

                card_add.push(show_count);
                card_add = $.unique(card_add);

                card_loops[show_count] = loops;                
                show_count++;
              } else {
                if (card_add.length > 0) {
                    console.log("Other Card=" + card_no);
                    var k = 0;
                    var duplicates = card_add;
                    var unique_cards = duplicates.unique();

                    var j = Math.floor(Math.random() * unique_cards.length);

                    if ($('.card-' + (card_no)).hasClass('show'))
                      k = $('.card-' + (card_no - 1) + ' .real-id').val();
                    else
                      k = $('.card-' + (card_no) + ' .real-id').val();

                    card_no++;
                    var appendTxt = '<div class="card-' + card_no + '">';

                    if (unique_cards.length == 1 && j == 1) { 
                      j = 0;
                    } else {
                       if (real_id[unique_cards[j]] == k) {

                        if (unique_cards.length == 1) { 
                          j = 0;
                        } else {
                          if (j == 0){
                            j ++;
                          } else if (j > 0 && (j == unique_cards.length - 1)) {
                            j --;
                          }
                        }
                      }
                    }
                    //console.log(real_id + "=" + unique_cards + "=" + j + "=" + k + "=" + real_id[unique_cards[j]]);

                    appendTxt += '<input type="hidden" class="real-id" value="' + real_id[unique_cards[j]] + '" />';
                    appendTxt += '<div class="card-number">Test Card ' + (unique_cards[j] + 1)  + '</div>';
                    appendTxt += '<div class="' + front_class[unique_cards[j]] + '">';
                    appendTxt += front_html[unique_cards[j]];
                    appendTxt += '</div><div class="' + back_class[unique_cards[j]] + '">';
                    appendTxt += back_html[unique_cards[j]];
                    appendTxt += '</div></div>';

                    $('.flow-cards').append(appendTxt);
                    appendFunc(card_no);

                } else {
                    card_no++;
                    var appendTxt = '<div class="card-' + card_no + '">';
                    appendTxt += '<div class="card-number">Result</div>';
                    appendTxt += '<div>';
                    appendTxt += 'You mastered the cards successfully';
                    appendTxt += '</div>';                    
                    appendTxt += '</div>';
 
                    $('.flow-cards').append(appendTxt);

                    appendFunc(card_no);
                    clearInterval(cardPlay);
                }
              }
            }
          } else {
              // when correct or master card
              var k = 0;
              var duplicates = card_add;
              var unique_cards = duplicates.unique();
              var j = Math.floor(Math.random() * unique_cards.length);
              
              if ($('.card-' + (card_no)).hasClass('show'))
                k = $('.card-' + (card_no - 1) + ' .real-id').val();
              else
                k = $('.card-' + (card_no) + ' .real-id').val();

              //real_id + "=" + unique_cards + "=" + j + "=" + k + "=" + real_id[unique_cards[j]]);

              card_no++;
              var appendTxt = '<div class="card-' + card_no + '">';

              if (unique_cards.length == 1 && j == 1) {
                j = 0;
              } else {
                 if (real_id[unique_cards[j]] == k) {
                  if (unique_cards.length == 1) {
                    j = 0;
                  } else {
                    if (j == 0)
                      j ++;
                    else if (j > 0 && (j < unique_cards.length - 1))
                      j --;
                   }
                }
              }

              appendTxt += '<input type="hidden" class="real-id" value="' + real_id[unique_cards[j]] + '" />';
              appendTxt += '<div class="card-number">Test Card ' + (unique_cards[j] + 1)  + '</div>';
              appendTxt += '<div class="' + front_class[unique_cards[j]] + '">';
              appendTxt += front_html[unique_cards[j]];
              appendTxt += '</div><div class="' + back_class[unique_cards[j]] + '">';
              appendTxt += back_html[unique_cards[j]];
              appendTxt += '</div></div>';

              $('.flow-cards').append(appendTxt);
              appendFunc(card_no);
          }
        }
      } else {
        incorrect_count++;
        card_loops[test_id] = loops;

        if (correct_count < Math.min(active, $('.hidden-cards>div').length / 2)) {
          card_no++;
          var appendTxt = '<div class="card-' + card_no + '">';

          appendTxt += '<input type="hidden" class="real-id" value="' + real_id[test_id] + '" />';
          appendTxt += '<div class="card-number">Test Card ' + (test_id + 1)  + '</div>';
          appendTxt += '<div class="' + front_class[test_id] + '">';
          appendTxt += front_html[test_id];
          appendTxt += '</div><div class="' + back_class[test_id] + '">';
          appendTxt += back_html[test_id];
          appendTxt += '</div></div>';

          $('.flow-cards').append(appendTxt);

          appendFunc(card_no);
        } else {
          // Incorrect

          var k = 0;
          var duplicates = card_add;
          var unique_cards = duplicates.unique();

          var j = Math.floor(Math.random() * unique_cards.length);

          if ($('.card-' + (card_no)).hasClass('show'))
            k = $('.card-' + (card_no - 1) + ' .real-id').val();
          else
            k = $('.card-' + (card_no) + ' .real-id').val();

          card_no++;
          var appendTxt = '<div class="card-' + card_no + '">';

          if (unique_cards.length == 1 && j == 1) { 
            j = 0;
          } else {
             if (real_id[unique_cards[j]] == k) {

              if (unique_cards.length == 1) { 
                j = 0;
              } else {
                  if (j == 0){
                    j ++;
                  } else if (j > 0 && (j < unique_cards.length - 1)) {
                    j --;
                  }
              }
            }
          }  
          //console.log(real_id + "=" + unique_cards + "=" + j + "=" + k + "=" + real_id[unique_cards[j]]);

          appendTxt += '<input type="hidden" class="real-id" value="' + real_id[unique_cards[j]] + '" />';
          appendTxt += '<div class="card-number">Test Card ' + (unique_cards[j] + 1)  + '</div>';
          appendTxt += '<div class="' + front_class[unique_cards[j]] + '">';
          appendTxt += front_html[unique_cards[j]];
          appendTxt += '</div><div class="' + back_class[unique_cards[j]] + '">';
          appendTxt += back_html[unique_cards[j]];
          appendTxt += '</div></div>';

          $('.flow-cards').append(appendTxt);
          appendFunc(card_no);        
        } 
      }
    }

    $('#correct-count b').text(correct_count.toString());
    $('#incorrect-count b').text(incorrect_count.toString());
  }

  Array.prototype.contains = function(v) {
      for(var i = 0; i < this.length; i++) {
          if(this[i] === v) return true;
      }
      return false;
  };

  Array.prototype.unique = function() {
      var arr = [];
      for(var i = 0; i < this.length; i++) {
          if(!arr.contains(this[i])) {
              arr.push(this[i]);
          }
      }
      return arr; 
  };

  function appendFunc(card_no) {

    $('.flow-cards .card-' + card_no + ' .prompt li input[type="radio"]').each(function() {
        var element = $(this).attr('id');

        var n = element.lastIndexOf("_"); 
        var id = element.substr(0, n + 1);
        $(this).attr('id', id + card_no);
        $(this).next().attr('for', id + card_no);
    });  

    $('.flow-cards .card-' + card_no + ' .prompt .cardoption').val('');

    $('.flow-cards .card-' + card_no + ' .answer-button').click(function() {
      $('.flow-cards>div').css('height', card_height);     
      answerfunc($(this));      
    });

    $('.flow-cards .card-' + card_no + ' .answer').keyup(function(e){
      var answer = $(this).val();
      var correct = $.trim($(this).parent().find('.correct').val());
     
      if (e.keyCode != 8 || 
        e.keyCode != 9 || 
        e.keyCode != 20 || 
        e.keyCode != 16 || 
        e.keyCode != 17 || 
        e.keyCode != 18 || 
        e.keyCode != 46) {
          if (answer == correct) {
            $(this).next().click();
            clearInterval(cardPlay);
            onNextSlider(wait_time);
          }
      }      
    });

    $('.flow-cards .card-' + card_no + ' .answer').keypress(function(e){
      if (e.keyCode == 13) {
        $(this).next().click();
        clearInterval(cardPlay);
        onNextSlider(wait_time);
      }
    });
    
    $('.flow-cards .card-' + card_no + ' input[type=radio]').click(function() {
      $(this).closest('.prompt').find('.cardoption').val($(this).val());      
      $(this).closest('.prompt').find('.answer-button').click();      
      clearInterval(cardPlay);
      onNextSlider(wait_time);
    });

    $('.flow-cards .card-' + card_no + ' .prompt ul div div:last-child').click(function() {
      if (!$(this).hasClass('selected')) {
        $(this).prev().find('input[type=radio]').click();
        $(this).prev().find('input[type=radio]').attr('checked', true);
        $(this).closest('ul').find('li').each(function() {
          $(this).find('div div:last-child').addClass('selected');
        });
      }
    });
  }

  $('.answer').keyup(function(e){
    var answer = $(this).val();
    var correct = $.trim($(this).parent().find('.correct').val());
    
    if (e.keyCode != 8 || 
      e.keyCode != 9 || 
      e.keyCode != 20 || 
      e.keyCode != 16 || 
      e.keyCode != 17 || 
      e.keyCode != 18 || 
      e.keyCode != 46) {

      if (answer == correct) {
        $(this).next().click();
        clearInterval(cardPlay);
        onNextSlider(wait_time);
      }
    }
  });

  $('.answer').keypress(function(e){
    if (e.keyCode == 13) {
      $(this).next().click();
      clearInterval(cardPlay);
      onNextSlider(wait_time);
    }   
  });

  $('input[type=radio]').click(function() {
    $(this).closest('.prompt').find('.cardoption').val($(this).val());    
    $(this).closest('.prompt').find('.answer-button').click();
    clearInterval(cardPlay);
    onNextSlider(wait_time);
  });

  $('.prompt ul div div:last-child').click(function() {
    if (!$(this).hasClass('selected')) {
      $(this).prev().find('input[type=radio]').click();
      $(this).prev().find('input[type=radio]').attr('checked', true);
      $(this).closest('ul').find('li').each(function() {
        $(this).find('div div:last-child').addClass('selected');
      });
    }
  });

  $('.finish').click(function() {
    $('#correct_cards').val(correct_count);
    $('#incorrect_cards').val(incorrect_count);
    $('#total_cards').val(play_cards);
    $('#total_time').val(totaltime);
    $('#mastered').val(mastered);

    $('#quizform').submit();
  });
});
</script>

@endsection