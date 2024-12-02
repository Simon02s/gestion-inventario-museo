const tabs = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    tabContents.forEach(tc => tc.classList.remove('active'));

    tab.classList.add('active');
    document.getElementById(tab.dataset.tab).classList.add('active');
  });
});
document.addEventListener('DOMContentLoaded', () => {
    const inventarioInput = document.getElementById('numero_inventario');
  
    // Agregar prefijo al iniciar el campo si no está presente
    inventarioInput.addEventListener('focus', () => {
      if (!inventarioInput.value.startsWith('MP-')) {
        inventarioInput.value = 'MP-';
      }
    });
  
    // Asegurarse de que el prefijo "MP-" no se elimine
    inventarioInput.addEventListener('input', () => {
      if (!inventarioInput.value.startsWith('MP-')) {
        inventarioInput.value = 'MP-' + inventarioInput.value.replace(/^MP-*/, '');
      }
    });
  
    // Evitar que el prefijo "MP-" se borre completamente
    inventarioInput.addEventListener('keydown', (e) => {
      if (e.target.selectionStart <= 3 && (e.key === 'Backspace' || e.key === 'Delete')) {
        e.preventDefault();
      }
    });
  });
  
  // Gráfica con Chart.js (requiere incluir Chart.js en el proyecto)
document.addEventListener('DOMContentLoaded', () => {
  const ctx = document.getElementById('categoryChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Escultura', 'Pintura', 'Textil', 'Otros'],
      datasets: [{
        data: [40, 25, 20, 15],
        backgroundColor: ['#004080', '#0073e6', '#66b3ff', '#cce5ff']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
});
