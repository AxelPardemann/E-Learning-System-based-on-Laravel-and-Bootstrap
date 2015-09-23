var UIExtendedModals = function () {

    
    return {
        //main function to initiate the module
        init: function () {
         
            // general settings
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';

            $.fn.modalmanager.defaults.resize = true;

            //ajax demo:
            var $modal = $('#full-width');

            $('#modal-ajax').on('click', function(event){
              
              event.preventDefault();

              var data_url = $('#modal-ajax').attr('data-url');                
              var data_key = $('#modal-ajax').attr('data-key'); 

              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
             
              setTimeout(function(){
                  $modal.load(data_url + '/' + data_key + '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $('.image-modal-ajax').on('click', function(event){
              
              event.preventDefault();

              var data_url = $(this).attr('data-url');
              var data_key = $(this).attr('data-key');

              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');

              setTimeout(function(){
                  $modal.load(data_url + '/' + data_key + '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $('.sound-modal-ajax').on('click', function(event){
             
              event.preventDefault();
              var data_url = $(this).attr('data-url');
              var data_key = $(this).attr('data-key');


              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
        
              setTimeout(function(){
                  $modal.load(data_url + '/' + data_key + '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $('.b-image-modal-ajax').on('click', function(event){
              
              event.preventDefault();

              var data_url = $(this).attr('data-url');
              var data_key = $(this).attr('data-key');
              var data_parent = $(this).attr('data-parent');
              var data_param = data_parent + ',' + data_key;
              
              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');

              setTimeout(function(){
                  $modal.load(data_url + '/' + data_param + '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $('.b-sound-modal-ajax').on('click', function(event){
             
              event.preventDefault();
              var data_url = $(this).attr('data-url');
              var data_key = $(this).attr('data-key');
              var data_parent = $(this).attr('data-parent');
              var data_param = data_parent + ',' + data_key;

              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
        
              setTimeout(function(){
                  $modal.load(data_url + '/' + data_param + '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $modal.on('click', '.update', function(){
              $modal.modal('loading');
              setTimeout(function(){
                $modal
                  .modal('loading')
                  .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                      'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '</div>');
              }, 1000);
            });
        }

    };

}();