describe('UC06_Admin - Buka Form Tambah Berita', () => {
    before(() => {
      // Login Admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Data Berita dari sidebar', () => {
      cy.contains('Data Berita').click();
      cy.url().should('include', '/admin/berita');
    });
  
    it('Admin klik tombol Tambah Berita dan form muncul', () => {
      // Cari button di dalam div #btnTambahBerita
      cy.get('#btnTambahBerita > button').should('exist').click();
  
      // Pastikan form tampil
      cy.get('#formBerita').should('be.visible');
    });
  });
  