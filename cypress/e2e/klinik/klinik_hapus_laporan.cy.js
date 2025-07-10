describe('UC20_Klinik - Hapus Laporan Klinik dari halaman Laporan', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('klinik_updated');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Klinik menghapus laporan dari daftar laporan', () => {
      cy.visit('http://127.0.0.1:8000/klinik/laporan');
  
      // Ambil jumlah baris sebelum dihapus
      cy.get('#rekamMedisTable tbody tr').then($rowsBefore => {
        const initialCount = $rowsBefore.length;
  
        // Temukan tombol hapus pertama dan submit langsung form-nya
        cy.get('form').filter(':has(button.btn-danger)').first().submit();
  
        // Tunggu reload atau proses selesai
        cy.wait(1000); // opsional, tergantung sistem
  
        // Cek jumlah baris berkurang
        cy.get('#rekamMedisTable tbody tr').should('have.length.lessThan', initialCount);
      });
    });
  });
  