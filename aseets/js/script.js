document.addEventListener("DOMContentLoaded", function() {
  const currentPath = window.location.pathname;
  const menuLinks = document.querySelectorAll(".menu a");

  menuLinks.forEach(link => {
      if (link.getAttribute("href") === currentPath.split('/').pop()) {
          link.classList.add("active");
      }
  });
});