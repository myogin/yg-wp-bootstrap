jQuery(function ($) {
  var $grid = $(".portfolio-container").isotope({
    // options
    itemSelector: ".portfolio-item",
  });
  $(".filter-button-group").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");
    $grid.isotope({ filter: filterValue });
  });
}); // jQuery End
