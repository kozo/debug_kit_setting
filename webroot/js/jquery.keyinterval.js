/*
 * jQuery keyinterval (jQuery Plugin)
 *
 * Copyright (c) 2010 Tom Shimada
 *
 * Depends Script:
 *	jquery.js (1.3.2)
 */

(function($) {
  $.fn.keyinterval = function(configs){
    var defaults = {
          interval: 500,
          callbackFunc: function() {}
        };
    if (!configs) return;
    configs = $.extend(defaults, configs);
    var $textbox = this;
    if (typeof($textbox) !== 'object' || $textbox.length !== 1) return;

    var termerId = null,
        val = $textbox.val();

    if (val) configs.callbackFunc();

    function monitor(event) {
      if (termerId) clearTimeout(termerId);
      termerId = setTimeout(action, configs.interval);
    }

    function action() {
      clearTimeout(termerId);
      timerId = null;
      var nowVal = $textbox.val();
      if (val != nowVal) {
        configs.callbackFunc();
        val = nowVal;
      }
    }

    function bind() {
      $textbox.keyup(monitor);
    }

    function unbind() {
      $textbox.unbind('keyup', monitor);
    }

    bind();

    return this;
  };
})(jQuery);
