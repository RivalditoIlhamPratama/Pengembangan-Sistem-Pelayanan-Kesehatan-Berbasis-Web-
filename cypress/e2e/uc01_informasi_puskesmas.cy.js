describe('UC01 - Melihat Informasi Puskesmas Kraksaan', () => {
  it('Pasien membuka halaman utama dan melihat informasi layanan', () => {
    cy.visit('http://127.0.0.1:8000/');
    cy.contains('Pelayanan Masyarakat');
    cy.contains('Puskesmas Kraksaan');
    cy.contains('Layanan Kami');
    cy.contains('Daftar Dokter');
    cy.contains('Jadwal Dokter');
    cy.contains('Layanan Pengaduan');
    cy.contains('Berita Puskesmas');
    cy.contains('Berita Terkait');
  });
});
