describe('UC03 - Melihat Jadwal Dokter', () => {
    it('Pasien membuka halaman daftar dokter, klik tombol Jadwal, dan melihat jadwal praktik dokter', () => {
      // Buka halaman utama
      cy.visit('http://127.0.0.1:8000/');
  
      // Klik menu Dokter di navbar
      cy.get('nav').contains('Dokter').click();
  
      // Pastikan sudah masuk halaman dokter
      cy.url().should('include', '/dokter');
  
      // Klik tombol "Jadwal" dokter pertama
      cy.contains('Jadwal').first().click();
  
      // Pastikan URL menuju halaman jadwal dokter
      cy.url().should('include', '/dokter/');
      cy.url().should('include', '/jadwal');
  
      // Cek heading halaman jadwal dokter
      cy.contains('Jadwal Pelayanan');
    });
  });
  