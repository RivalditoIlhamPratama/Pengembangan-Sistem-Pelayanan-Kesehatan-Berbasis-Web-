describe('UC06_Admin - Melihat Halaman Data Berita', () => {
    before(() => {
      // Login sebagai Admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Data Berita dari sidebar', () => {
      cy.contains('Data Berita').click();
      cy.url().should('include', '/admin/berita'); // Sesuaikan dengan route sebenarnya di Laravel-mu
    });
  });
  