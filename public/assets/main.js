document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen DOM
    const menuBtn = document.getElementById("menu-btn");
    const navLinks = document.getElementById("nav-links");
    const menuBtnIcon = menuBtn?.querySelector("i");

    // Validasi elemen ada
    if (!menuBtn || !navLinks || !menuBtnIcon) {
        console.error("❌ Elemen menu tidak ditemukan!");
        return;
    }

    // Inisialisasi state menu
    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            navLinks.classList.add("open");
            document.body.style.overflow = "hidden";
            menuBtnIcon.setAttribute("class", "ri-close-line");
        } else {
            navLinks.classList.remove("open");
            document.body.style.overflow = "";
            menuBtnIcon.setAttribute("class", "ri-menu-line");
        }
    }

    // Toggle menu saat tombol diklik
    menuBtn.addEventListener("click", (e) => {
        e.stopPropagation(); // Hindari bubbling
        toggleMenu();
    });

    // Tutup menu saat link di dalam menu diklik
    navLinks.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => {
            if (isMenuOpen) toggleMenu();
        });
    });

    // Tutup menu jika tekan tombol Escape
    document.addEventListener("keydown", (e) => {
        if (isMenuOpen && e.key === "Escape") {
            toggleMenu();
        }
    });

    // Optional: Tutup menu jika klik di luar menu
    // document.addEventListener("click", (e) => {
    //     if (isMenuOpen && !navLinks.contains(e.target) && !menuBtn.contains(e.target)) {
    //         toggleMenu();
    //     }
    // });

    // ======================
    // Scroll Reveal Section
    // ======================

    const scrollRevealOption = {
        distance: "50px",
        origin: "bottom",
        duration: 1000,
    };

    ScrollReveal().reveal(".header__image img", {
        ...scrollRevealOption,
    });

    ScrollReveal().reveal(
        ".header__content h4, .header__content .section__header",
        {
            ...scrollRevealOption,
            delay: 500,
        }
    );

    ScrollReveal().reveal(".header__content p", {
        ...scrollRevealOption,
        delay: 1000,
    });

    ScrollReveal().reveal(".header__btn", {
        ...scrollRevealOption,
        delay: 1500,
    });

    ScrollReveal().reveal(".doctor-card-container", {
        ...scrollRevealOption,
        delay: 500,
    });

    ScrollReveal().reveal(".services-section", {
        ...scrollRevealOption,
        delay: 300,
    });

    ScrollReveal().reveal(".berita--container", {
        ...scrollRevealOption,
        delay: 750,
    });

    ScrollReveal().reveal(".doctor-card", {
        ...scrollRevealOption,
        delay: 750,
    });

    ScrollReveal().reveal(".doctor-container", {
        ...scrollRevealOption,
        delay: 750,
    });

    ScrollReveal().reveal(".container", {
        ...scrollRevealOption,
        delay: 750,
    });

    ScrollReveal().reveal(".pengaduan-container", {
        ...scrollRevealOption,
        delay: 750,
    });
});
