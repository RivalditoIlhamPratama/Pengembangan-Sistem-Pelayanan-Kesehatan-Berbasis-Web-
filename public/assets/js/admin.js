document.addEventListener("DOMContentLoaded", function() {
    let links = document.querySelectorAll(".sidebar ul li a");
    links.forEach(link => {
        link.addEventListener("click", function() {
            links.forEach(l => l.classList.remove("active"));
            this.classList.add("active");
        });
    });

    let menuToggle = document.querySelector(".menu-toggle");
    let sidebar = document.querySelector(".sidebar");
    
    menuToggle.addEventListener("click", function() {
        sidebar.classList.toggle("open");
    });
});
