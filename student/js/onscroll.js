window.onload = function() {



  function getScrollTop() {

    if (typeof window.pageYOffset !== 'undefined' ) {

      return window.pageYOffset;

    }

    

    var d = document.documentElement;

    if (d.clientHeight) {

      return d.scrollTop;

    }



    return document.body.scrollTop;

  }



  window.onscroll = function() {

    var box = document.getElementById('box'),

        scroll = getScrollTop();



    if (scroll <= 8) {

      box.style.top = "5px";

    }

    else {

      box.style.top = (scroll +2) + "px";

    }

  };



};