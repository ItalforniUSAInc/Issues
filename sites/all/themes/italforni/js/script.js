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
    
  }
};


})(jQuery, Drupal, this, this.document);
