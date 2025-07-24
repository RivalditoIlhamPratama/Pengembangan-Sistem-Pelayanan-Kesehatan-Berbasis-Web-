describe('UC14_StaffRekamMedis - Update Akun Staff dari halaman Data Staff', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('staffpuskesmas');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Staff mengubah data akun dari halaman Data Staff', () => {
      cy.visit('http://127.0.0.1:8000/staff/data-staffrm');
  
      // Cek form ada (dengan ID atau alternatif)
      cy.get('form').first().should('exist');
  
      // Update username
      cy.get('input[name="username"]').clear().type('staff_updated');
  
      // Klik tombol simpan
      cy.get('button[type="submit"]').click();
  
      // Verifikasi notifikasi berhasil
      cy.contains('Berhasil!').should('exist');
    });
  });
  