(function(){
	$(function(){
    mediaUploader();
  });

  function mediaUploader(){
    var $wp = wp,
        $mediaUploader = $wp.media.frames.file_frame = $wp.media({
          title: 'Choose a Profile Picture',
          button: {
            text: 'Choose Picture'
          },
          multiple: false
        });

    $('#upload-button').on('click', function(e){
      e.preventDefault();
      if ($mediaUploader === undefined){
        $mediaUploader.open();

        return;
      }
      $mediaUploader.on('select', function(){
        var $attachment = $mediaUploader.state().get('selection').first().toJSON();

        $('#profile-picture').val($attachment.url);
        $('#profile-picture-preview').css('background-image','url('+ $attachment.url +')');
      });
      $mediaUploader.open();
    });

    $('#remove-picture').on('click', function(e){
      e.preventDefault();
      var $answer = window.confirm('Are you sure you want to remove your profile picture?');

      if ($answer === true) {
        window.console.log('Yes please remove');
        $('#profile-picture').val('');
        $('#profile-picture-preview').removeAttr("style");
        $('.freelance-general-form').submit();
      }else{
        window.console.log("No, please dont't");
        return;
      }

    });
  }
}) (jQuery);
