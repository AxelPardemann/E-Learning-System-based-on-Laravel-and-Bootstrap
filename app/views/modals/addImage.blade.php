<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Add Image file</h4>
</div>
<div class="modal-body">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-align-justify"></i> Add Image form
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->			
				<br>
				<input type="hidden" id="key" value="{{$key}}" />
				<input type="hidden" id="parent" value="{{$parent}}" />
				<input type="hidden" id="type" value="{{$type}}" />
				<div id="divAdd" style="display:block;">
					<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn btn-success fileinput-button">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Add files...</span>
						<!-- The file input field used as target for the file upload widget -->
						<input id="fileupload" type="file" name="files" multiple>
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

<script>
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/addImageFile';

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                
                var type = $('#type').val();
                var key = $( '#key' ).val();
                var parent = $( '#parent' ).val();

                if (file.url) {
                    if (type == 'front') {  

                        $( '#f_image_previewer-' + parent ).css('display', 'block'); 
                        $( '#f_image_add-' + parent ).css('display', 'none');                   
                        $( '#f_image_preview-' + parent ).html("<img id='f_img-" + parent + "'' src='"+ file.url +"' />");

                        $( '#f_image-' + parent ).val(file.url);

                    } else {

                        $( '#b_image_previewer-' + parent + '-' + key ).css('display', 'block');  
                        $( '#b_image_add-' + parent + '-' + key).css('display', 'none');                
                        $( '#b_image_preview-' + parent + '-' + key ).html("<img id='b_img-" + parent + '-' + key + "' src='"+ file.url +"' />");

                        $( '#b_sub_image-' + parent + '-' + key ).val(file.url);

                    }                
                    
                    var link = $('<a>')
                        .attr('target', '_blank')
                        .prop('href', file.url);
                    $(data.context.children()[index])
                        .wrap(link);
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
