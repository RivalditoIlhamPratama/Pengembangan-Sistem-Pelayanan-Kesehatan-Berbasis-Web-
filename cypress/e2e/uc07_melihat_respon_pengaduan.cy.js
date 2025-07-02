describe('UC07 - Melihat Respon Pengaduan dari Admin', () => {
    it('Pasien login dan melihat respon dari admin di halaman pengaduan', () => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('pasien1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
  
      cy.visit('http://127.0.0.1:8000/pasien/aduan');
  
      cy.contains('Respon Admin Puskesmas Kraksaan');
    });
  });
  