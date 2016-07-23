(function () {
  'use strict';

  var errors = $('.help-block');
  if (errors.length > 0) {
    errors.parent().addClass('has-error');
    // fix for select2
    var select = $('span.select2-selection');
    if (select.parent().parent().parent().hasClass('has-error')) {
      select.css('border', '2px solid rgb(231, 76, 60)');
    }
  }
}());