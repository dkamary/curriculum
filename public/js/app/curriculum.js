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

    // Job type filter
    $(".job-type-element").on("click", (e) => {
      e.preventDefault();
      const $this = $(e.currentTarget);
      const id = $this.data("id");
      const formFilter = $("#form-filter");
      const action = formFilter.attr("action");
      const job = formFilter.find("#job");
      const page = formFilter.find("#page").val();
      const perpage = formFilter.find("#perpage").val();
      const container = $("#post-container");
      job.val(id);
      $(".post-list .cat-list li.active").removeClass("active");
      $this.parent().addClass("active");
      $.ajax({
        type: "get",
        url: `${action}/${page}/${perpage}/${id}`,
        beforeSend: () => {
          container.html(
            $("<div>", {
              html:
                'Chargement de la liste en cours <i class="fa fa-refresh animated rotateIn infinite" aria-hidden="true"></i>',
              style: "text-align: center",
            })
          );
        },
      })
        .done((response) => {
          container.html(response);
        })
        .fail((xhr) => {
          container.html(xhr.responseText);
        });
    });
  });
})(window.jQuery, window, window.document);
