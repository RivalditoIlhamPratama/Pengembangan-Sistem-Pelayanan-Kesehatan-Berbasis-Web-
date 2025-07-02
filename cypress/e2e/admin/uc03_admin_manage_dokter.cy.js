describe('UC03_Admin - Lihat Data Dokter', () => {
    before(() => {
      // Login Admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password'); // Ganti dengan password admin yang sesuai
      cy.get('button[type="submit"]').click();
  
      // Pastikan berhasil masuk dashboard
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Data Dokter dari sidebar', () => {
      cy.contains('Data Dokter').click();
  
      // Pastikan URL sudah sesuai
      cy.url().should('include', '/admin/data-dokter');
  
      // Pastikan halaman menampilkan judul
      cy.contains('Data Dokter');
  
      // Pastikan tabel dokter muncul
      cy.get('table').should('exist');
  
      // Pastikan ada minimal 1 dokter (opsional, bisa dihapus kalau datanya kosong)
      cy.get('table tbody tr').its('length').should('be.gte', 1);
    });
  });
  