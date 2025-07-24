describe('UC13_Dokter - Update Akun Dokter dari halaman Data Dokter', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('huda fathullah ');
      cy.get('input[name="password"]').type('password12345');
      cy.get('button[type="submit"]').click();
    });
  
    it('Dokter mengubah data akun dari halaman Data Dokter', () => {
      cy.visit('http://127.0.0.1:8000/dokter/data_dokter');
  
      // Gunakan salah satu:
      // 1. Jika sudah tambahkan ID:
      cy.get('form').first().should('exist');

      // 2. Jika belum tambahkan ID, pakai partial selector:
      // cy.get('form[action*="data_dokter"]').should('exist');
  
      // Update hanya username
      cy.get('input[name="username"]').clear().type('huda fathullah');
  
      cy.get('button[type="submit"]').click();
  
      cy.contains('Berhasil!').should('exist'); // SweetAlert atau notifikasi
    });
  });
  