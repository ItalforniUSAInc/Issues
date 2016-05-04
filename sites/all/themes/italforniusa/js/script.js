(function ($, Drupal, window, document, undefined) {


Drupal.behaviors.italforniusa = {
  attach: function(context, settings) {
    
    // accordion
    $('.accordion').accordion({
      //defaultOpen: 'section1',
    });
		
		$('.accordion-attachment').accordion({
      cssClose: 'accordion-attachment-close',
      cssOpen: 'accordion-attachment-open',
    });

    // Tooltip only Text
    $('.masterTooltip').hover(function(){
      // Hover over code
      var title = $(this).attr('title');
      $(this).data('tipText', title).removeAttr('title');
      $('<p class="tooltip"></p>')
        .text(title)
        .appendTo('body')
        .fadeIn('slow');
      }, function() {
        // Hover out code
        $(this).attr('title', $(this).data('tipText'));
        $('.tooltip').remove();
      }).mousemove(function(e) {
        var mousex = e.pageX + 10; //Get X coordinates
        var mousey = e.pageY + 10; //Get Y coordinates
        $('.tooltip')
        .css({ top: mousey, left: mousex })
    });
    
  }
};


})(jQuery, Drupal, this, this.document);
