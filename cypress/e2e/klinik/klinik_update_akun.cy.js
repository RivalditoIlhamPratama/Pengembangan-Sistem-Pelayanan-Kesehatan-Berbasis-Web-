describe('UC16_Klinik - Update Akun Klinik dari halaman Data Klinik', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('klinik Gigi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Klinik mengubah data akun dari halaman Data Klinik', () => {
      cy.visit('http://127.0.0.1:8000/klinik/profil');
  
      // Pastikan form tersedia
      cy.get('form').first().should('exist');
  
      // Update kolom nama klinik atau username
      cy.get('input[name="username"]').clear().type('klinik_updated');
  
      // Simpan perubahan
      cy.get('button[type="submit"]').click();
  
      // Cek notifikasi berhasil
      cy.contains('Berhasil!').should('exist');
    });
  });
  