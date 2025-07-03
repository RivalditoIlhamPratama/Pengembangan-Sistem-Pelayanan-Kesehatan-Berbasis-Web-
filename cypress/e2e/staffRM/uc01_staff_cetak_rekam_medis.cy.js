describe('UC01_StafRekamMedis - Klik Detail lalu Cetak Rekam Medis', () => {
    before(() => {
      // Login sebagai Staff RM
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('staff1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/stafrekammedis/dashboard');
    });
  
    it('Staff klik tombol Detail lalu klik Cetak di modal Resume Medis', () => {
      // Buka halaman dashboard staff
      cy.visit('http://127.0.0.1:8000/stafrekammedis/dashboard');
  
      // Pastikan tabel ada
      cy.get('#rekamMedisTable').should('exist');
  
      // Klik tombol Detail pertama
      cy.get('button.detail-btn').first().click();
  
      // Pastikan modal resume detail muncul
      cy.get('#detailModal').should('exist').and('have.class', 'show');
  
      // Klik tombol Cetak
      cy.get('#printDetail').should('exist').click();
  
    });
  });
  