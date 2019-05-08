
//variáveis
var altura = 0
var largura = 0
var vidas = 1
var tempo = 45
var criaMosquitoTempo = 1500

//recupera o parametro passado na página anterior
var nivel = window.location.search

//remove o ? da variavel nivel
nivel = nivel.replace('?', '')

//verifica o nivel selecionacio e modifica o tempo de criação do mosquito
if(nivel === 'normal') {
	criaMosquitoTempo = 1500
}
else if(nivel === 'dificil') {
	criaMosquitoTempo = 1000
}
else if(nivel === 'muito_dificil') {
	criaMosquitoTempo = 750
}

//recupera o tamanho da tela
function ajustaTamanhoPalcoJogo() {
	altura = window.innerHeight
	largura = window.innerWidth
}

ajustaTamanhoPalcoJogo()

//passa o tempo de jogo para a tela de jogo
var cronometro = setInterval(function() {

	tempo--

	if(tempo < 0) {
		clearInterval(cronometro)
		clearInterval(criaMosquito)
		window.location.href = '../paginas/vitoria.html'
	}
	else {
		document.getElementById('cronometro').innerHTML = tempo	
	}	
}, 1000)


//funcao para posicionar randomicamente o mosquito na tela
function posicaoRandomica() {

	//remover o mosquito anterior (caso exista)
	if(document.getElementById('mosquito')) {
		document.getElementById('mosquito').remove()

		//verifica se já perdeu todas as vidas, senão tira uma vida
		if(vidas > 3) {
			window.location.href = '../paginas/fim_de_jogo.html'
		} 
		else {
			document.getElementById('v' + vidas).src = "../imagens/coracao_vazio.png"

			vidas++
		}
	}

	//gera as posicoes sem deixar sumir da tela
	var posicaoX = Math.floor(Math.random() * largura) - 90
	var posicaoY = Math.floor(Math.random() * altura) - 90

	posicaoX = posicaoX < 0 ? 0 : posicaoX
	posicaoY = posicaoY < 0 ? 0 : posicaoY

	console.log(posicaoX, posicaoY)

	//criar o elemento html
	var mosquito = document.createElement('img')
	mosquito.src = '../imagens/mosca.png'
	mosquito.className = tamanhoAleatorio() + ' ' + ladoAleatorio()
	mosquito.style.left = posicaoX + 'px'
	mosquito.style.top = posicaoY + 'px'
	mosquito.style.position = 'absolute'
	mosquito.id = 'mosquito'
	mosquito.onclick = function () {
		this.remove()
	}

	document.body.appendChild(mosquito)
}

//funcao para tamanhos diferentes de mosquito
function tamanhoAleatorio() {
	var classe = Math.floor(Math.random() * 3)

	switch(classe) {
		case 0:
			return 'mosquito1'

		case 1:
			return 'mosquito2'

		case 2:
			return 'mosquito3'
	}
}

//funcao para alterar o lado que o mosquito aparece olhando
function ladoAleatorio() {
	var classe = Math.floor(Math.random() * 2)

	switch(classe) {
		case 0:
			return 'ladoA'

		case 1:
			return 'ladoB'
	}
}

