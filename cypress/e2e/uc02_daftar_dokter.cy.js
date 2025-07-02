describe('UC02 - Melihat Daftar Dokter', () => {
    it('Pasien membuka halaman utama, klik menu Dokter, dan melihat daftar dokter', () => {
      cy.visit('http://127.0.0.1:8000/');
  
      // Klik menu Dokter di navbar
      cy.get('nav').contains('Dokter').click();
  
      // Pastikan URL setelah klik sesuai (ubah jadi /dokter)
      cy.url().should('include', '/dokter');
  
      // Cek heading halaman
      cy.contains('Dokter Puskesmas Kraksaan');
  
      // Cek nama-nama dokter
      cy.contains('Siti Jamila, Amd. Keb');
      cy.contains('drg. Dwi Wahyudi');
      cy.contains('dr. Fathullah Huda');
  
      // Pastikan ada tombol "Jadwal"
      cy.contains('Jadwal');
    });
  });
  