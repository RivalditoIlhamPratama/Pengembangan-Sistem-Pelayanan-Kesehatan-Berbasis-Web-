describe('UC10_Dokter - Edit Nama Pasien dan klik Update Rekam Medis', () => {
    before(() => {
      // Login sebagai Dokter
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('drg-dwi-wahyudi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Dokter membuka form edit dan update nama pasien', () => {
      // Buka halaman rekam medis
      cy.visit('http://127.0.0.1:8000/dokter/rekam_medis');
  
      // Pastikan tabel muncul
      cy.get('#rekamMedisTable').should('exist');
      
      // Klik tombol Edit pertama
      cy.get('a.btn-warning').first().click();
  
      // Pastikan modal edit muncul
      cy.get('#editRekamModal').should('exist').and('have.class', 'show');
  
      // Ganti Nama Pasien
      cy.get('#editNamaPasien').clear().type('Muhammad Fahri Ramadhan');
  
      // Klik tombol Update
      cy.contains('button', 'Update Rekam Medis').click();
  
      // Verifikasi redirect kembali ke halaman rekam medis
      cy.url().should('include', '/dokter/rekam_medis');
  
      // Opsional: Pastikan nama baru tampil di tabel
      cy.get('#rekamMedisTable tbody tr').first().should('contain.text', 'Muhammad Fahri Ramadhan');
    });
  });
  