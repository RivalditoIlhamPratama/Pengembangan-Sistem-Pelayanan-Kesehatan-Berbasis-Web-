describe('UC01_Admin - Login sebagai Admin', () => {
    it('Admin berhasil login dan masuk ke dashboard', () => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
  
      cy.url().should('include', '/admin/dashboard');
      cy.contains('Dashboard Admin');
    });
  });
  