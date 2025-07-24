describe('UC07_Dokter - Membuka Halaman Rekam Medis Pasien', () => {
    before(() => {
      // Login sebagai Dokter
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('drg-dwi-wahyudi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/dokter/dashboard');
    });
  
    it('Dokter membuka halaman Rekam Medis dari sidebar', () => {
      cy.contains('Rekam Medis').click();
      cy.url().should('include', '/dokter/rekam_medis');
    });
  });
  