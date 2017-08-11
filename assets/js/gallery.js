var FT_Gallery, friday_news_toolkit_gallery, friday_news_toolkit_gallery_button;

jQuery(document).ready(function() {
  FT_Gallery.init();
});

jQuery(document).ajaxSuccess(function() {
  FT_Gallery.init();
});

friday_news_toolkit_gallery = '';

friday_news_toolkit_gallery_button = '';

FT_Gallery = {
  init: function() {
    jQuery('.fd-gallery-box').on('click', '.fd-gallery-config', function(event) {
      event.preventDefault();
      friday_news_toolkit_gallery_button = jQuery(this);
      if (friday_news_toolkit_gallery) {
        friday_news_toolkit_gallery.open();
        return;
      }
      friday_news_toolkit_gallery = wp.media.frames.friday_news_toolkit_gallery = wp.media({
        title: 'Gallery config',
        button: {
          text: 'Use'
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      friday_news_toolkit_gallery.on('open', function() {
        var ids, selection;
        ids = friday_news_toolkit_gallery_button.parents('.fd-gallery-box').find('input.fd-gallery').val();
        if ('' !== ids) {
          selection = friday_news_toolkit_gallery.state().get('selection');
          ids = ids.split(',');
          jQuery(ids).each(function(index, element) {
            var attachment;
            attachment = wp.media.attachment(element);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
          });
        }
      });
      friday_news_toolkit_gallery.on('select', function() {
        var result, selection;
        result = [];
        selection = friday_news_toolkit_gallery.state().get('selection');
        selection.map(function(attachment) {
          attachment = attachment.toJSON();
          return result.push(attachment.id);
        });
        if (result.length > 0) {
          result = result.join(',');
          friday_news_toolkit_gallery_button.parents('.fd-gallery-box').find('input.fd-gallery').val(result);
        }
      });
      friday_news_toolkit_gallery.open();
    });
  }
};
