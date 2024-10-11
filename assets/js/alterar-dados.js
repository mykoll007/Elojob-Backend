document.getElementById('btn-editar').addEventListener('click', function(event) {
    event.preventDefault(); // Previne o comportamento padrão do botão

    // Seleciona todos os inputs no formulário
    const inputs = document.querySelectorAll('input');
    
    inputs.forEach(input => {
        input.removeAttribute('readonly'); // Remove o atributo readonly
        input.style.opacity = '100%'; // Define a opacidade para 100%
    });
});