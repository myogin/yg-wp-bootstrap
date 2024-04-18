"use strict";
var theme = {
  init: function () {
    theme.stickyHeader();
  },
  stickyHeader: () => {
    if (null != document.querySelector(".navbar-scroll"))
      new Headhesive(".navbar-scroll", {
        offset: 400,
        offsetSide: "top",
        classes: {
          clone: "navbar-clone",
          stick: "navbar-stick",
          unstick: "navbar-unstick",
        },
        onStick: function () {
          var e = this.clonedElem.classList;
          e.contains("transparent") &&
            e.contains("navbar-dark") &&
            (this.clonedElem.className = this.clonedElem.className.replace(
              "navbar-dark",
              "navbar-light",
              "navbar-stick"
            ));
          if (null != this.clonedElem.querySelector(".offcanvas"))
            this.clonedElem.querySelector(".offcanvas").removeAttribute("id");
        },
      });
  },
};
theme.init();
