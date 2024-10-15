//Perguntas Frequentes - Accordeon

let accordeon1 = document.getElementById("accordeon1");
let accordeon2 = document.getElementById("accordeon2");
let accordeon3 = document.getElementById("accordeon3");
let accordeon4 = document.getElementById("accordeon4");

//Accordeon 1

document.getElementById("btn-acordeon1").addEventListener("click", function () {
  const seta = document.querySelector("#btn-acordeon1 img");
  accordeon1.classList.toggle("active");

  if (accordeon1.classList.contains("active")) {
    seta.src = "assets/images/seta-cima.png";
  } else {
    seta.src = "assets/images/seta-baixo.png";
  }
});

//Accordeon 2

document.getElementById("btn-acordeon2").addEventListener("click", function () {
  const seta = document.querySelector("#btn-acordeon2 img");
  accordeon2.classList.toggle("active");

  if (accordeon2.classList.contains("active")) {
    seta.src = "assets/images/seta-cima.png";
  } else {
    seta.src = "assets/images/seta-baixo.png";
  }
});
//Accordeon 3

document.getElementById("btn-acordeon3").addEventListener("click", function () {
  const seta = document.querySelector("#btn-acordeon3 img");
  accordeon3.classList.toggle("active");

  if (accordeon3.classList.contains("active")) {
    seta.src = "assets/images/seta-cima.png";
  } else {
    seta.src = "assets/images/seta-baixo.png";
  }
});
//Accordeon 4
document.getElementById("btn-acordeon4").addEventListener("click", function () {
  const seta = document.querySelector("#btn-acordeon4 img");
  accordeon4.classList.toggle("active");

  if (accordeon4.classList.contains("active")) {
    seta.src = "assets/images/seta-cima.png";
  } else {
    seta.src = "assets/images/seta-baixo.png";
  }
});

//Rolagem Suave no "Inicie Sua Ascensão"
document.querySelector("#container-infos a").addEventListener("click", function (event) {
  event.preventDefault(); // Evita o comportamento padrão do link
  const targetId = this.getAttribute("href"); // Obtém o ID de destino
  const targetElement = document.querySelector(targetId); // Seleciona o elemento de destino

  if (targetElement) {
    window.scrollTo({
      top: targetElement.offsetTop, // Posição do elemento no topo
      behavior: "smooth", // Rolagem suave
    });
  }
});

//Hover Suave no "Pronto para sua Ascensão?"
const alignChamada = document.getElementById("align-chamada");
const heading = alignChamada.querySelector("h2");
const image = alignChamada.querySelector("img");

alignChamada.addEventListener("mouseenter", function () {
  heading.style.transform = "scale(1.05)";
  image.style.transform = "translateX(10px) scale(1.05)";
});

alignChamada.addEventListener("mouseleave", function () {
  heading.style.transform = "scale(1)";
  image.style.transform = "translateX(0) scale(1)";
});

//Rolagem Suave no "Pronto para sua Ascensão?"
document
  .querySelector("#chamada-serv a")
  .addEventListener("click", function (event) {
    event.preventDefault(); // Evita o comportamento padrão do link
    const targetId = this.getAttribute("href"); // Obtém o ID de destino
    const targetElement = document.querySelector(targetId); // Seleciona o elemento de destino

    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop, // Posição do elemento no topo
        behavior: "smooth", // Rolagem suave
      });
    }
  });

//Rolagem Suave no Serviços do Footer
document
  .querySelector("#servicos a")
  .addEventListener("click", function (event) {
    event.preventDefault();
    const targetId = this.getAttribute("href");
    const targetElement = document.querySelector(targetId);

    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop,
        behavior: "smooth",
      });
    }
  });

  // Modal Digite o Código 
  
  // Manipulando Input para ser 1 digito e passar para o próximo quando digitado
  function moveFocus(currentInput, nextInputName) {
    // Verifica se o valor do campo atual não é um dígito válido
    if (!/^\d?$/.test(currentInput.value)) {
        // Limpa o campo se não for um dígito válido
        currentInput.value = '';
    }

    // Move o foco para o próximo campo se um dígito for digitado
    if (currentInput.value.length === 1) {
        const nextInput = document.querySelector(`input[name="${nextInputName}"]`);
        nextInput?.focus();
    }
}






// Modais Abrir e Fechar
const btnIniciar = document.getElementById('btnIniciar');
const modalIniciar = document.getElementById('modalIniciar');
const closeButtons = document.querySelectorAll('.close'); // Seleciona todos os botões de fechar
const btnCadastrar = document.querySelector('.register-text a:nth-of-type(1)'); 
const btnEsqueceuSenha = document.getElementById('esqueceu-senha');
const modalRecuperarSenha = document.getElementById('modalRecuperarSenha');
const modalDigiteCodigo = document.getElementById('modalDigiteCodigo');
const modalRenovaSenha = document.getElementById('modalRenovaSenha');
const modalMensagemSenha = document.getElementById('modalMensagemSenha');
const modalMensagemExcluido = document.getElementById('modalMensagemExcluido');

// Função para fechar todos os modais
function closeModals() {
  modalIniciar.style.display = 'none';
  document.getElementById('modalRegistrar').style.display = 'none';
  document.getElementById('modalRecuperarSenha').style.display = 'none';
  modalDigiteCodigo.style.display = 'none';
  modalRenovaSenha.style.display = 'none';
  modalMensagemSenha.style.display = 'none';
  modalMensagemExcluido.style.display = 'none';
}

// Função para abrir o modal de iniciar sessão
function openModalIniciar() {
  modalIniciar.style.display = 'flex';
  modalIniciar.style.position = 'fixed';
}

// Função para abrir o modal de registro
function openModalRegistrar() {
  closeModals(); // Fecha outros modais
  document.getElementById('modalRegistrar').style.display = 'flex';
  document.getElementById('modalRegistrar').style.position = 'fixed';
}

// Função para abrir o modal de recuperação de senha
function openModalRecuperarSenha() {
  closeModals(); // Fecha outros modais
  document.getElementById('modalRecuperarSenha').style.display = 'flex';
  document.getElementById('modalRecuperarSenha').style.position = 'fixed';
}

// Função para abrir o modal de digitar código
function openModalDigiteCodigo() {
  closeModals(); // Fecha outros modais abertos
  modalDigiteCodigo.style.display = 'flex'; 
  modalDigiteCodigo.style.position = 'fixed';
}

function openModalMensagem(){
  closeModals();
  modalMensagemSenha.style.display = 'flex';
  modalMensagemSenha.style.position = 'fixed';
}

function openModalMensagemExcluido(){
  closeModals();
  modalMensagemExcluido.style.display = 'flex';
  modalMensagemExcluido.style.position = 'fixed';
}

// Fechar modais ao clicar no "X"
closeButtons.forEach(button => {
  button.addEventListener('click', () => {
    closeModals(); // Fecha todos os modais quando o "X" for clicado
  });
});

// Eventos de clique
btnIniciar.addEventListener('click', (event) => {
  event.preventDefault(); // Previne o comportamento padrão do link
  openModalIniciar();
});

btnCadastrar.addEventListener('click', (event) => {
  event.preventDefault(); // Previne o comportamento padrão do link
  openModalRegistrar();
});

btnEsqueceuSenha.addEventListener('click', (event) => {
  event.preventDefault(); // Previne o comportamento padrão do link
  openModalRecuperarSenha();
});

//Consentimento de cookies
window.onload = function() {
  const consentDate = localStorage.getItem('cookiesConsentDate');
  const currentDate = new Date();

  // 365 dias em milissegundos
  const oneYear = 365 * 24 * 60 * 60 * 1000;

  if (!localStorage.getItem('cookiesAccepted') || (consentDate && (currentDate - new Date(consentDate) > oneYear))) {
      document.getElementById('cookie-consent').style.display = 'block';
  }

  document.getElementById('accept-cookies').onclick = function() {
      localStorage.setItem('cookiesAccepted', 'true');
      localStorage.setItem('cookiesConsentDate', currentDate);
      document.getElementById('cookie-consent').style.display = 'none';
  };
};






