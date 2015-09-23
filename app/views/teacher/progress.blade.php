@extends('layouts.default')

@section('globalStyles')
{{HTML::style('assets/css/jquery.datatables.css')}}
{{HTML::style('assets/css/morris.css')}}
@endsection

@section('pageContainer')  
<div class="mainpanel">
   <!-- headerbar -->
  @section('headerbar')
    @include('teacher.teacher_nav')
  @endsection
  <!-- headerbar -->
   
  <div class="contentpanel">
    <input type="hidden" name="school_id" id="school_id" value="{{$school_id}}">
    {{Form::open(array('url' => 'progress/update', 'method' => 'post', 'class' => 'horizontal-form', 'id' => 'progressUpdate'))}}
    <input type="hidden" name="type" id="type">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="state" id="state">
    <input type="hidden" name="response" id="response">
    <input type="hidden" name="loops" id="loops">
    <input type="hidden" name="active" id="active">

    {{Form::close()}}
    <div class="row">
      <div class="chart_large">
        <div class="mrnd">                
            <ul>
              <li>
                <span class="col-md-2">Sprint</span>                             
                <span class="col-md-1">Date</span>
                <span class="col-md-1">Correct</span>
                <span class="col-md-1">Incorrect</span>
                <span class="col-md-1">Speed</span>
                <span class="col-md-1">Wait</span>
                <span class="col-md-1">Loop</span>
                <span class="col-md-1">Active</span>
                <span class="col-md-1">Status</span>
                <span class="col-md-3">&nbsp;</span>
              </li>
              <?php $i = 0;?>
              @foreach ($sprints as $sprint)
               <li @if ($i % 2 == 0) class="even" @else class="odd" @endif>
                <span class="col-md-2">{{$sprint->sprint_name}}</span> 
                <span class="col-md-1">{{Studentprogress::getUpdatedAtAttribute($sprint->updated_at)}}</span>
                <span class="col-md-1">{{$sprint->correctCards}}</span>
                <span class="col-md-1">{{$sprint->incorrectCards}}</span>
                <span class="col-md-1">{{$sprint->speed}}</span>
                <span class="col-md-1">
                  <select id="choose-wait-{{$sprint->id}}" name="choose-wait" class="chosen-select">
                    @foreach($wait as $key=>$value)                                      
                      @if ($value == $sprint->response)
                        <option value="{{$value}}" selected>{{$sprint->response}}</option>        
                      @else
                        <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @endforeach
                  </select>
                </span>
                <span class="col-md-1">
                  <select id="choose-loops-{{$sprint->id}}" name="choose-loops" class="chosen-select">
                    @foreach($loops as $key=>$value)                                      
                      @if ($value == $sprint->loops)
                        <option value="{{$value}}" selected>{{$sprint->loops}}</option>        
                      @else
                        <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @endforeach
                  </select>
                </span>
                <span class="col-md-1">
                  <select id="choose-active-{{$sprint->id}}" name="choose-active" class="chosen-select">
                    @foreach($active as $key=>$value)                                      
                      @if ($value == $sprint->active)
                        <option value="{{$value}}" selected>{{$sprint->active}}</option>        
                      @else
                        <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @endforeach
                  </select>
                </span>
                <span class="col-md-1">
                  <select id="choose-status-{{$sprint->id}}" name="choose-status" class="chosen-select-status">
                    @foreach($status as $key=>$value)
                      @if ($value == $sprint->status)
                        <option value="{{$value}}" selected>{{$sprint->status}}</option>
                      @else
                        <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @endforeach                                     
                  </select>
                </span>
                <button class="btn btn-primary btn-sm btn-reset" data-key="{{$sprint->id}}">Reset</button>
                &nbsp;&nbsp;
                <button class="btn btn-success btn-sm btn-save" data-key="{{$sprint->id}}">Save</button>
                &nbsp;&nbsp;
                <button class="btn btn-lightblue btn-sm btn-progress" data-key="{{$sprint->sprint}}">Progress</button>
                &nbsp;&nbsp;
                <button class="btn btn-lightblue btn-sm btn-transaction" data-key="{{$sprint->sprint}}">Transaction</button>
              </li>
              <li>
                <div class="chart_small">
                  <div class="mrnd">
                    <div></div>
                  </div>
                </div>
              </li>
              <?php $i++; ?>
              @endforeach
            </ul>
          </div>                   
          <div class="clear"></div>
        </div>
      </div>          
    </div><!-- row -->       
  </div><!-- contentpanel -->    
</div><!-- mainpanel -->   
@endsection

@section('pageLevelPlugins')
{{ HTML::script('assets/js/jquery.form.min.js') }}

{{ HTML::script('assets/js/flot/flot.min.js') }}
{{ HTML::script('assets/js/flot/flot.resize.min.js') }}
{{ HTML::script('assets/js/flot/flot.symbol.min.js') }}
{{ HTML::script('assets/js/flot/flot.crosshair.min.js') }}
{{ HTML::script('assets/js/flot/flot.categories.min.js') }}
{{ HTML::script('assets/js/morris.min.js') }}
{{ HTML::script('assets/js/raphael-2.1.0.min.js') }}
@endsection

@section('javaScript')

<script>
  jQuery(document).ready(function() {     
  	$( '#mainbody' ).addClass('horizontal-menu');

    // Chosen Select
    jQuery(".chosen-select").chosen({
      'width':'70px',   
      'white-space':'nowrap',
      disable_search_threshold: 10
    });   

    jQuery(".chosen-select-status").chosen({
      'width':'100px',   
      'white-space':'nowrap',
      disable_search_threshold: 10
    }); 

    $('.btn-reset').on('click', function(event){
      var key = $(this).attr('data-key');

      jQuery("#type").val('reset');
      jQuery("#id").val(key);
      jQuery("#response").val("");
      jQuery("#loops").val("");
      jQuery("#active").val("");
      jQuery("#state").val("");

      $('#progressUpdate').ajaxForm(options).submit(); 
    });

    $('.btn-save').on('click', function(event){
      var key = $(this).attr('data-key');
      var response = $('#choose-wait-' + key).val();
      var loops = $('#choose-loops-' + key).val();
      var active = $('#choose-active-' + key).val();
      var status = $('#choose-status-' + key).val();
      
      jQuery("#type").val('update');
      jQuery("#id").val(key);
      jQuery("#response").val(response);
      jQuery("#loops").val(loops);
      jQuery("#active").val(active);
      jQuery("#state").val(status);

      $('#progressUpdate').ajaxForm(options).submit(); 
    });

    $('.btn-progress').on('click', function(e){
      $('.chart_small').hide();
      $('.chart_small .mrnd div').attr('id', '');
      $(this).parent().next().find('.mrnd div').attr('id', 'line-chart');
      $(this).parent().next().find('.chart_small').fadeIn( 2000 );
      $('#line-chart').fadeIn( 2000 );

      e.preventDefault();

      var key = $(this).attr('data-key');
      var school_id = $('#school_id').val();

      $.ajax({
        type: "POST",
        url : "../teacher/viewProgress",
        data: { id: key, school_id: school_id },
        success : function(data){
          var chartData = [];
          var parsed = JSON.parse(data);
          var arr = [];

          for(var x in parsed){
            arr.push(parsed[x]);
          }

          for (var i = 0; i < arr.length; i++) 
            chartData.push({ y: arr[i][0], a: arr[i][1], b: arr[i][2] });
          
          $('#line-chart').empty();
          showProgress(chartData);
        }
      },"json");
    });

    $('.btn-transaction').on('click', function(e){
      $('.chart_small').hide();
      $('.chart_small .mrnd div').attr('id', '');
      $(this).parent().next().find('.mrnd div').attr('id', 'basicflot2');
      $(this).parent().next().find('.chart_small').fadeIn( 2000 );
      $('#basicflot2').fadeIn( 2000 );

      e.preventDefault();

      var key = $(this).attr('data-key');
      var school_id = $('#school_id').val();

      $.ajax({
        type: "POST",
        url : "../teacher/viewTransaction",
        data: { id: key, school_id: school_id },
        success : function(data){
          var max = [];
          var min = [];
          var arr = [];
          var parsed = JSON.parse(data);
          var max_val = 0;

          for(var x in parsed){
            arr.push(parsed[x]);
            arr[x][0] = arr[x][0].toString();
          }

          for (var i = 0; i < arr.length; i++) {
            if (arr[i][1] > max_val)
              max_val = arr[i][1];
            max.push([arr[i][0], arr[i][1]]);
            min.push([arr[i][0], arr[i][2]]);
          }
          $('#basicflot2').empty();
          showTransaction(max, min, max_val);
        }
      },"json");
    });
  });

  var options = {       
    success:  showResponse,
    dataType: 'json' 
  }; 


  function showResponse(response, statusText, xhr, $form)  { 
    if (response.result == true) {        
      var id = response.id;
      var wait = response.wait;
      var loops = response.loops;
      var active = response.active;
      var state = response.state;

      $('#choose-wait-' + id).val(wait);
      $('#choose_wait_' + id + '_chosen span').text(wait);        

      $('#choose-loops-' + id).val(loops);
      $('#choose_loops_' + id + '_chosen span').text(loops);   

      $('#choose-active-' + id).val(active);
      $('#choose_active_' + id + '_chosen span').text(active);   

      $('#choose-status-' + id).val(state);
      $('#choose_status_' + id + '_chosen span').text(state);

      alert(response.message);
    } else {
      alert("It's failed");
    }
  }

  function showTooltip(x, y, contents) {
    jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
      position: 'absolute',
      display: 'none',
      top: y + 5,
      left: x + 5
    }).appendTo("body").fadeIn(0);
  }

  function showProgress(chartData) {
    new Morris.Line({
        element: 'line-chart',
        data: chartData,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Correct', 'Incorrect'],
        lineColors: ['#428BCA', '#D9534F'],
        lineWidth: '2px',
        hideHover: true
    });
  }

  function showTransaction(max, min, max_val) {
    var plot2 = jQuery.plot(jQuery("#basicflot2"),
    [
      { 
        data: max,
        label: "Max Response Time",
        color: "#D9534F",
        points: {
          symbol: "circle"
        }
      },
      { 
        data: min,
        label: "Min Response Time",
        color: "#428BCA",
        points: {
          symbol: "circle"
        }
      }
    ],
    {
      series: {
        lines: {
            show: true,
            lineWidth: 2
          },
        points: {
            show: true
          },
        shadowSize: 0
      },
      grid: {
        hoverable: true,
        clickable: true,
        borderColor: '#ddd',
        borderWidth: 1,
        labelMargin: 10,
        backgroundColor: '#fff'
      },
      yaxis: {
        min: 0,
        max: parseInt(max_val) + 1,
        color: '#eee'
      },
      xaxis: {
        min: parseInt(max[0][0]),
        max: parseInt(max[max.length - 1][0]),
        color: '#eee'
      }
    });

    var previousPoint = null;
    jQuery("#basicflot2").bind("plothover", function (event, pos, item) {
      var previousPoint2 = null;
      $("#tip").remove();
      jQuery('<div id="tip">Click for Detail</div>').css( {
        position: 'absolute',
        display: 'none',
        top: item.pageY + 5,
        left: item.pageX + 5
      }).appendTo("body").fadeIn(0);
    });

    $("#basicflot2").bind("plotclick", function (event, pos, item) {
      var previousPoint2 = null;
      $("#tooltip").remove();
      if(item) {
        var x = item.datapoint[0],
        y = item.datapoint[1];

        var sprint_id = $(this).closest('li').prev().find('.btn-transaction').attr('data-key');
        var school_id = $('#school_id').val();

        $.ajax({
          type: "POST",
          url : "../teacher/viewDetail",
          data: { school_id: school_id, sprint_id: sprint_id, card: x },
          success : function(data){
            var txt = '<br />';
            var arr = [];
            var parsed = JSON.parse(data);

            for(var i in parsed)
              arr.push(parsed[i]);

            for (var i = 0; i < arr.length; i++)
              txt += "<br /><span>" + arr[i][0] + " = " + arr[i][1] + "s</span>";

            var class_str = '';
            if (item.series.label == "Max Response Time")
              class_str = 'max';
            else
              class_str = 'min';

            showTooltip(item.pageX, item.pageY,
              "<b><span style='margin-left: 75px;'>" + "Card " + x + "</span></b><br />" + 
              "<span class='" + class_str + "'>" + item.series.label + " = " + y + "s</span>" + txt);
          }
        },"json");
      }
    });
    
    var temp = -1;
    $('.flot-text .flot-x-axis>div').each(function() {
      if (parseInt($(this).text()) == temp) {
        $(this).text('');
      } else {
        $(this).text(parseInt($(this).text()));
        temp = parseInt($(this).text());
      }
    });
  }

  $('body section').click(function() {
    $("#tooltip").remove();
  });

</script>

@endsection