describe('UC02_Admin - Manage Data Akun Pengguna edit', () => {
    beforeEach(() => {
      // Login ulang sebelum setiap test case
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membuka halaman Data Pengguna dari sidebar', () => {
      // Klik sidebar menu
      cy.contains('Data Pengguna').click();
  
      // Pastikan URL halaman users
      cy.url().should('include', '/admin/users');
  
      // Pastikan header halaman ada
      cy.contains('Data Pengguna');
    });
  
    it('Admin menghapus user Zidan', () => {
        cy.visit('http://127.0.0.1:8000/admin/users');
      
        cy.get('table tbody tr').contains('Zidan').parents('tr').within(() => {
          cy.get('form button.btn-danger').click();
        });
      
        cy.on('window:confirm', () => true);
      
        // Baris notifikasi DIHAPUS
      });
      
  });
  