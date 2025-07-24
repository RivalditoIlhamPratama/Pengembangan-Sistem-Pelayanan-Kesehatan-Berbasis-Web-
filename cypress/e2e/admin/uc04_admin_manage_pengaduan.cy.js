describe('UC04_Admin - Manage Data Pengaduan Pasien', () => {
    before(() => {
      // Login Admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');  // Ganti sesuai password Admin-mu
      cy.get('button[type="submit"]').click();
  
      // Pastikan redirect dashboard
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Data Pengaduan', () => {
      // Klik menu sidebar Data Pengaduan
      cy.contains('Data Pengaduan').click();
  
      // Pastikan URL sesuai
      cy.url().should('include', '/admin/data-pengaduan');
  
      // Pastikan halaman memiliki heading
      cy.contains('Data Pengaduan');
  
      // Pastikan tabel tampil
      cy.get('table').should('exist');
    });
  });
  