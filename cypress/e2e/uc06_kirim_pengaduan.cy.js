describe('UC06 - Kirim Pengaduan Online', () => {
    it('Pasien login, membuka halaman pengaduan, mengisi form, dan mengirim pengaduan', () => {
      // Login
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('pasien1');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
  
      // Buka halaman pengaduan
      cy.visit('http://127.0.0.1:8000/pasien/aduan');
  
      // Pilih jenis pengaduan
      cy.get('select').select('Pelayanan');
  
      // Isi pesan
      cy.get('textarea').eq(0).type('Pengaduan test dari Cypress');
  
      // Submit
      cy.get('button').contains('Kirim Pengaduan').click();
  
      // Cek notifikasi sukses (ganti sesuai notifikasi asli di aplikasi kamu)
      cy.contains('Pengaduan berhasil dikirim');
    });
  });
  