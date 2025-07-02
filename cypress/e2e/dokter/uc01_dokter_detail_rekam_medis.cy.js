describe('UC11_Dokter - Klik tombol Detail lalu klik Cetak Resume Medis', () => {
    before(() => {
      // Login sebagai Dokter
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('drg-dwi-wahyudi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Dokter klik Detail dan tombol Cetak', () => {
      // Buka halaman Rekam Medis
      cy.visit('http://127.0.0.1:8000/dokter/rekam_medis');
  
      // Pastikan tabel rekam medis muncul
      cy.get('#rekamMedisTable').should('exist');
  
      // Klik tombol Detail pertama
      cy.get('button.detail-btn').first().click();
  
      // Pastikan modal detail muncul
      cy.get('#detailModal').should('exist').and('have.class', 'show');
  
      // Pastikan isi No RM dan Nama Pasien tampil
      cy.get('#detailNo').should('not.be.empty');
      cy.get('#detailPasien').should('not.be.empty');
  
      // Klik tombol Cetak
      cy.get('#printDetail').should('exist').click();
  
      // ✅ Opsional: Karena window.print tidak bisa benar-benar dites di Cypress,
      // kita hanya pastikan tidak error setelah klik tombol.
    });
  });
  