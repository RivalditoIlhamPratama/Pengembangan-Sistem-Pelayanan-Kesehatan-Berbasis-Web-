const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

// header container
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

// Menerapkan animasi ScrollReveal pada kontainer kartu dokter
ScrollReveal().reveal(".doctor-card-container", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 500, //
});


// Menerapkan animasi ScrollReveal pada kontainer services
ScrollReveal().reveal(".services-section", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 300, //
});

// Menerapkan animasi ScrollReveal pada kontainer berita
ScrollReveal().reveal(".berita--container", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 750, //
});


// Menerapkan animasi ScrollReveal pada kontainer kartu dokter
ScrollReveal().reveal(".doctor-card", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 750, //
});




// Menerapkan animasi ScrollReveal pada kontainer kartu dokter
ScrollReveal().reveal(".doctor-container", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 750, //
});


// Menerapkan animasi ScrollReveal pada container jadawal dokter 
ScrollReveal().reveal(".container", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 750, //
});


ScrollReveal().reveal(".pengaduan-container", {
  ...scrollRevealOption, // Menggunakan opsi default
  delay: 750, //
});
