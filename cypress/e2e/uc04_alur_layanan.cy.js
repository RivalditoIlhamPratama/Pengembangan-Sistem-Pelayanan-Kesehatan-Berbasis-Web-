describe('UC04 - Melihat Alur Layanan', () => {
    it('Pasien membuka halaman utama, klik menu Pelayanan, dan melihat alur layanan', () => {
      cy.visit('http://127.0.0.1:8000/');
      cy.get('nav').contains('Pelayanan').click();
      cy.url().should('include', '/alur-pelayanan');
      cy.contains('Alur Pelayanan');
    });
  });
  