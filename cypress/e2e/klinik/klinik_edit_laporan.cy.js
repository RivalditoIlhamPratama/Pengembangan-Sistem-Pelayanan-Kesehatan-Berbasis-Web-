describe('UC19_Klinik - Edit Laporan Klinik', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('klinik_updated');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Klinik mengedit laporan klinik yang sudah ada', () => {
      cy.visit('http://127.0.0.1:8000/klinik/laporan');
  
      // Klik tombol Edit pada baris pertama
      cy.get('a.btn-warning').first().click();
      cy.url().should('include', '/klinik/laporan/edit');
  
      // Ubah isi Diagnosa & Tindakan
      cy.get('input[name="diagnosaMedis"]').clear().type('Infeksi Saluran Pernapasan');
      cy.get('input[name="deskripsi_tindakan"]').clear().type('Pemberian antibiotik dan istirahat total');
  
      // Submit perubahan
      cy.get('button[type="submit"]').click();
  
      // Verifikasi pesan sukses
      cy.contains('Berhasil!').should('exist');
    });
  });
  