(function ($, Drupal, once) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      const selector = $(".block__title", context);
      console.log(selector);
    },
  };
})(jQuery, Drupal, once);
