document.addEventListener("DOMContentLoaded", function() {
    var currentLocation = window.location.href;
    var navLinks = document.querySelectorAll(".menu a");
  
    navLinks.forEach(function(link) {
      if (link.href === currentLocation) {
        link.classList.add("active");
      }
    });
  });