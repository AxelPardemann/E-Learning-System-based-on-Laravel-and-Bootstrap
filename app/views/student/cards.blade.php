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
     
    <!-- <div class="mode-wrapper">
    	<nav class="modes">
    		{{Form::open(array('url' => 'student_quiz', 'method' => 'post', 'autocomplete' => 'off'))}}
    		<input type="hidden" name="id" value="{{$sprint_id}}">
	      	<div class="mode">
	      		<div class="mode-wrap">
	      			<span class="backdrop">
	      				<button class="mode-link"></button>
	      			</span>
	      			<div class="mode-icon">
	      				<span class="fa fa-play"></span>
	      			</div>
	      			<div class="text">
	      				<span class="name">Flashcards</span>
	      			</div>
	      		</div>
	      	</div>
	      	{{ Form::close() }}	      	
	    </nav>
    </div> -->  
    <div class="contentpanel">      
      <div class="row">
      	<div class="contentlist col-md-10">
	        <div class="table-responsive col-md-12">
	        	<table class="table card-table">
	        		<tbody>
	        			<?php $i = 0; ?>
	        			@foreach ($cards as $card)
	        			<tr>
	        				<td>
	        					<span class="fa">{{$card->f_text}}</span>
	        					<audio class="player" src="{{$card->f_sound_path}}{{$card->f_sound}}"></audio>
	        				</td>
	        				@if ($card->card_type == 'singlecard')
	        				<td>
	        					<span class="fa">{{$card->b_text}}</span>
	        					<audio class="player" src="{{$card->b_sound_path}}{{$card->b_sound}}"></audio>
	        				</td>
	        				<td>
	        					<span class="fa fa-volume-up"></span>
	        					<audio class="player" src="{{$card->b_sound_path}}{{$card->b_sound}}"></audio>
	        				</td>
	        				@elseif ($card->card_type == 'radiocard')
	        				<td>
	        					<span class="fa">{{$subcards[$i]->answer}}</span>
	        					<audio class="player" src="{{$subcards[$i]->b_sound_path}}{{$subcards[$i]->b_sound}}"></audio>
	        				</td>
	        				<td>
	        					<span class="fa fa-volume-up"></span>
	        					<audio class="player" src="{{$subcards[$i]->b_sound_path}}{{$subcards[$i]->b_sound}}"></audio>
	        				</td>
	        				@endif
	        			</tr>
	        			<?php $i++; ?>
	        			@endforeach
	        		</tbody>
	        	</table>
	        </div>
	    </div>
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

<script>
jQuery(document).ready(function() {     
	$( '#mainbody' ).addClass('horizontal-menu');

	$('.player').player();

	$('.mode-wrap').hover(function() {
		$(this).find('.text').removeClass('mouseout');
		$(this).find('.text').addClass('mouseon');
	}, function() {
		$(this).find('.text').removeClass('mouseon');
		$(this).find('.text').addClass('mouseout');
	});

	$('.card-table td>span').click(function() {
		$(this).closest('td').find('.simpleplayer-play-control').click();
	});
});
</script>

@endsection