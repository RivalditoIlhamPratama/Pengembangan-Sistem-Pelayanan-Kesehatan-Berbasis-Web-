describe('UC18_Klinik - Tambah Laporan Klinik', () => {
    before(() => {
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('klinik_updated');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Klinik menambahkan laporan klinik baru', () => {
      cy.visit('http://127.0.0.1:8000/klinik/laporan');
      
      // Klik tombol Tambah
      cy.contains('Tambah').click();
      cy.url().should('include', '/klinik/laporan/tambah');
  
      // Pilih dokter
      cy.get('select[name="namaDokter"]').select('drg. Dwi Wahyudi');
  
      // Isi input manual
      cy.get('input[name="namaPasien"]').type('Anisa Pratiwi');
      cy.get('input[name="NIK"]').type('3509010101010001');
      cy.get('input[name="alamatPasien"]').type('Jl. Kenanga No.5');
      cy.get('input[name="diagnosaMedis"]').type('Demam Berdarah');
      cy.get('input[name="tindakan"]').type('Pemeriksaan darah dan rawat jalan');
  
      // Submit form
      cy.get('button[type="submit"]').click();
  
      // Verifikasi redirect kembali atau notifikasi sukses
      
    });
  });
  