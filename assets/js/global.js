//Hamburguer
function clickMenu() {
  const itens = document.getElementById('itens');
  const btnIniciar = document.getElementById('btnIniciar');

  // Verifica o estado atual do menu e alterna entre mostrar e esconder
  if (itens.style.display === "block") {
    itens.style.display = "none";
    if (btnIniciar) btnIniciar.style.display = "none";
  } else {
    itens.style.display = "block";
    if (btnIniciar) btnIniciar.style.display = "flex";
  }
}


document.addEventListener ('DOMContentLoaded', function() {
  const avatar = document.querySelector('.avatar');
  const containerUsuario = document.querySelector('.content-usuario');
  const menuIcon = document.getElementById('IconMenu');

  menuIcon.addEventListener('click', function() {
    clickMenu();
  });

  avatar.addEventListener('click', function(event) {
      // Alterna a visibilidade do container
      if (containerUsuario.style.display === 'none' || containerUsuario.style.display === '') {
          containerUsuario.style.display = 'block'; 
      } else {
          containerUsuario.style.display = 'none'; 
      }

      // Impede que o clique no avatar esconda a div imediatamente
      event.stopPropagation();
  });

  document.addEventListener('click', function(event) {
      // Verifica se o clique ocorreu fora da containerUsuario e do avatar
      if (!containerUsuario.contains(event.target) && !avatar.contains(event.target)) {
          containerUsuario.style.display = 'none'; // Esconde a div
      }
  });
});

