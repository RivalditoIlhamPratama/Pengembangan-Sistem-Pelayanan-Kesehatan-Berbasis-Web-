describe('UC04_Admin - Membalas Pengaduan Pasien lewat Chat', () => {
    before(() => {
      // Login admin
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('admin1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
      cy.url().should('include', '/admin/dashboard');
    });
  
    it('Admin membalas pengaduan pasien lewat Chat', () => {
        // Buka halaman Data Pengaduan
        cy.visit('http://127.0.0.1:8000/admin/data-pengaduan');
      
        // Pastikan tabel pengaduan tampil
        cy.get('table').should('exist');
      
        // Klik tombol Chat (warna biru) di baris kedua pengaduan
        cy.get('table tbody tr').eq(1).within(() => {
          cy.get('a.btn-primary').click();
        });
      
        // Tunggu sampai halaman Chat terbuka
        cy.url().should('include', '/admin/chat');
      
        // Pastikan input pesan tampil
        cy.get('input[name="message"]').should('exist');
      
        // Ketik pesan
        cy.get('input[name="message"]').type('Ini adalah balasan dari admin via Cypress');
      
        // Klik tombol Kirim
        cy.get('button[type="submit"]').click();
      
        // Verifikasi bahwa pesan muncul di chat box
        cy.get('#chat-box').contains('Ini adalah balasan dari admin via Cypress');
      });
      
      
  });
  