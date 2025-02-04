function openModal(modalId) {
     const modal = document.getElementById(modalId);
     if (modal) {
          modal.showModal(); // Abre la modal
     }
}

// Cierra la modal cuando se hace clic en el botón de cerrar
document.addEventListener('DOMContentLoaded', () => {
     const closeButtons = document.querySelectorAll('.close-dialog');
     closeButtons.forEach(button => {
          button.addEventListener('click', (event) => {
               const dialog = event.target.closest('dialog');
               if (dialog) {
                    dialog.close(); // Cierra la modal
               }
          });
     });
});