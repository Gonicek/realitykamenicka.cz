var real_estate_property_keyboard_navigation_loop = function (elem) {
  var real_estate_property_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var real_estate_property_firstTabbable = real_estate_property_tabbable.first();
  var real_estate_property_lastTabbable = real_estate_property_tabbable.last();
  real_estate_property_firstTabbable.focus();

  real_estate_property_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      real_estate_property_firstTabbable.focus();
    }
  });

  real_estate_property_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      real_estate_property_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};