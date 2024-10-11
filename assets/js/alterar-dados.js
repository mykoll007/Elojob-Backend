
//Abrir inputs para editar
function enableInputs() {
    const inputs = document.querySelectorAll('input');
    
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.style.opacity = '100%';
    });
}

document.getElementById('btn-editar').addEventListener('click', function(event) {
    event.preventDefault();
    enableInputs();
});


//Fechar os modais
function closeModals() {
    document.getElementById('modalMensagemSenha').style.display = 'none';
  }






