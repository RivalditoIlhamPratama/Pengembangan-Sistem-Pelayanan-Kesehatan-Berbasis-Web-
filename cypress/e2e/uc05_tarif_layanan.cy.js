describe('UC05 - Melihat Tarif Layanan', () => {
    it('Pasien membuka halaman utama dan klik menu Pelayanan menuju halaman tarif', () => {
      // Buka halaman utama
      cy.visit('http://127.0.0.1:8000/');
  
      // Klik menu Pelayanan
      cy.get('nav').contains('Pelayanan').click();
  
      // Cek URL sesuai
      cy.url().should('include', '/alur-pelayanan');
  
      // (Tidak ada cek teks karena konten tarif belum dibuat)
    });
  });
  