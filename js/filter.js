document.querySelector('.main-input').addEventListener('input', function() {
     let filter = this.value.toLowerCase();
     let items = document.querySelectorAll('.servicios-grid-item');

     items.forEach(function(item) {
          let serviceName = item.querySelector('h4').textContent.toLowerCase();
          let serviceDesc = item.querySelector('p').textContent.toLowerCase();

          if (serviceName.includes(filter) || serviceDesc.includes(filter)) {
               item.style.display = 'block';
          } else {
               item.style.display = 'none';
          }
     });
});