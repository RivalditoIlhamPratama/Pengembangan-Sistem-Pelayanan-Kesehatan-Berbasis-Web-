describe('UC10_Dokter - Klik tombol Export PDF Rekam Medis', () => {
    before(() => {
      // Login sebagai Dokter
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('drg-dwi-wahyudi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Dokter klik tombol Export PDF di halaman Rekam Medis', () => {
      // Buka halaman Rekam Medis
      cy.visit('http://127.0.0.1:8000/dokter/rekam_medis');
  
      // Pastikan tabel muncul
      cy.get('#rekamMedisTable').should('exist');
  
      // Klik tombol Export PDF
      cy.get('#exportPdf').should('exist').click();
  
      // ✅ Tidak perlu cek file download, cukup pastikan tidak ada error setelah klik
    });
  });
  