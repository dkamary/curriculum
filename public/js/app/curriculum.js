// Custom Curriculum script
(function ($, window, document) {
  $(function () {
    const pathname = window.location.pathname;
    if (pathname.length > 1) {
      const pageTitle = $("#page-title");
      console.log(pageTitle);
      if (pageTitle.length) {
        $("html, body").animate(
          {
            scrollTop: pageTitle.offset().top - 80,
          },
          1000
        );
        console.log({
          top: pageTitle.offset().top,
          length: pageTitle.length,
        });
      }
    }

    // Anchor animated
    $(".anchor").on("click", (e) => {
      e.preventDefault();
      const $this = $(e.currentTarget);
      const target = $(`${$this.attr("href")}`);
      if (target.length) {
        $("html, body").animate(
          {
            scrollTop: target.offset().top - 80,
          },
          1000
        );
      }
    });
  });
})(window.jQuery, window, window.document);
