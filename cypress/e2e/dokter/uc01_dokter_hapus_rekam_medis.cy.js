describe('UC12_Dokter - Hapus Rekam Medis dan pastikan data terhapus', () => {
    before(() => {
      // Login sebagai Dokter
      cy.visit('http://127.0.0.1:8000/login');
      cy.get('input[name="username"]').type('drg-dwi-wahyudi');
      cy.get('input[name="password"]').type('password');
      cy.get('button[type="submit"]').click();
    });
  
    it('Dokter klik Delete dan data hilang dari tabel', () => {
      cy.visit('http://127.0.0.1:8000/dokter/rekam_medis');
  
      cy.get('#rekamMedisTable').should('exist');
  
      cy.get('#rekamMedisTable tbody tr').first().find('td:nth-child(2)').then(($cell) => {
        const namaPasien = $cell.text().trim();
  
        cy.get('form.delete-form button.delete-button').first().click();
  
        cy.get('.swal2-popup').should('exist');
        cy.get('.swal2-title').should('contain.text', 'Yakin ingin menghapus?');
  
        cy.get('.swal2-confirm').click();
  
        // Bypass error frontend sementara
        cy.on('uncaught:exception', () => false);
  
        cy.url().should('include', '/dokter/rekam_medis');
  
        cy.wait(1000); // Opsional kalau reload lambat
        cy.get('#rekamMedisTable tbody').should('not.contain.text', namaPasien);
      });
    });
  });
  