<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Add Sound file</h4>
</div>
<div class="modal-body">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-align-justify"></i> Add Sound form
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->			
				<br>
				<input type="hidden" id="key" value="{{$key}}" />
				<input type="hidden" id="parent" value="{{$parent}}" />
				<input type="hidden" id="type" value="{{$type}}" />
				<div class="divAdd" style="display:block;">
					<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn btn-success fileinput-button">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Add files...</span>
						<!-- The file input field used as target for the file upload widget -->
						<input id="soundFileupload" type="file" name="files" multiple>
					</span>
					<br>
					<br>
					<!-- The global progress bar -->
					<div id="progress" class="progress">
						<div class="progress-bar progress-bar-success"></div>
					</div>
					<!-- The container for the uploaded files -->
					<div id="files" class="files"></div>
				</div>			
			<!-- END FORM-->
		</div>
	</div>
</div><!--/modal-body-->
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>
<!-- BEGIN IMAGE CROPPING -->
<script>
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/addSoundFile';

    $('#soundFileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(mp3)$/i,
        maxFileSize: 50000000, // 50 MB
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                
                var key = $( '#key' ).val(); 
                var type = $( '#type' ).val(); 
                var parent = $( '#parent' ).val();

                if (file.url != "") {  

                    var audioText = "";
                    if (type == 'front') {

                        $( '#f_sound_previewer-' + parent ).css('display', 'block');
                        $( '#f_sound-' + parent ).val(file.url);                    
                        $( '#f_sound_add-' + parent ).css('display', 'none');    
                        audioText = '<p><audio id="f_audio-' + parent + '" controls="" src="' + file.url + '"></audio></p>';
                        $( '#f_sound_preview-' + parent ).html(audioText); 
                    } else {
                        $( '#b_sound_previewer-' + parent + '-' + key ).css('display', 'block');
                        $( '#b_sound_add-' + parent + '-' + key ).css('display', 'none'); 
                        $( '#b_sub_sound-' + parent + '-' + key ).val(file.url);
                        audioText = '<p><audio id="b_audio-' + parent + '-' + key + '" controls="" src="'+ file.url +'"></audio></p>';
                        $( '#b_sound_preview-' + parent + '-' + key ).html(audioText); 
                    }                 
                    
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                }
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        fail: function(e, data) {
            $.each(data.files, function (index, file) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });           
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
