(function ($, Drupal, once) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      $("body", context).append("<div id='scroll-button'>UP</div>");
      buttonToTop = document.getElementById("scroll-button");
      buttonToTop.onmousedown = function () {
        document.documentElement.scrollTop = 0;
      };

      window.onscroll = function () {
        scrollFunction();
      };

      function scrollFunction() {
        if (document.documentElement.scrollTop > 600) {
          buttonToTop.style.display = "block";
        } else {
          buttonToTop.style.display = "none";
        }
      }
    },
  };
})(jQuery, Drupal, once);
