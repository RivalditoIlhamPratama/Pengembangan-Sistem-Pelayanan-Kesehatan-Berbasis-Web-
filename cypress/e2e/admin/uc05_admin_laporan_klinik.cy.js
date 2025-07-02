describe('UC05_Admin - Melihat Laporan Klinik', () => {
    before(() => {
      // Login Admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
  
      // Pastikan berhasil login ke dashboard
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Laporan Klinik dari sidebar', () => {
      // Klik menu sidebar "Laporan Klinik"
      cy.contains('Laporan Klinik').click();
  
      // Pastikan URL berubah ke halaman laporan klinik
      cy.url().should('include', '/admin/laporan-klinik');
  
      // Pastikan tabel laporan klinik tampil (boleh kosong ataupun ada isi)
      cy.get('table').should('exist');
    });
  });
  