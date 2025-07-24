describe('UC15_Admin - Update Akun Admin dari halaman Data Admin', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('adminbaru');
      cy.get('input[name="password"]').type('password12345');
      cy.get('button[type="submit"]').click();
    });
  
    it('Admin mengubah data akun dari halaman Data Admin', () => {
      cy.visit('http://127.0.0.1:8000/admin/profil');
  
      // Cek apakah form ada
      cy.get('form').first().should('exist');
  
      // Ubah username saja
      cy.get('input[name="username"]').clear().type('admin_updated');
  
      // Submit form
      cy.get('button[type="submit"]').click();
  
      // Verifikasi pesan sukses
      cy.contains('Berhasil!').should('exist');
    });
  });
  