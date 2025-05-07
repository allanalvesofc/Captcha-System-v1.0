<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CAPTCHA</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .captcha-container {
	  color: #ddd;
    margin: 50px auto;
    text-align: center;
  }
</style>
</head>
<body>
<div class="captcha-container">
  <h2>CAPTCHA</h2>
  <canvas id="captcha-canvas" width="130" height="50"></canvas>
  <br>
  <input type="text" id="captcha-input" placeholder="Digite o texto da imagem">
  <br>
  <button onclick="validateCaptcha()">Verificar</button>
  <p id="captcha-result"></p>
</div>

<script>
var att = 0;

  function generateCaptcha() {
    // Gera um texto aleatório para o CAPTCHA
    let captchaText = generateRandomText(6);
    
    // Desenha o texto do CAPTCHA no canvas
    let canvas = document.getElementById('captcha-canvas');
    let ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.font = '30px Arial';
	
	ctx.fillStyle = '#066';
    ctx.fillText(captchaText, 10, 35);
    
    // Armazena o texto do CAPTCHA na sessão
    sessionStorage.setItem('captcha', captchaText);
  }

  function generateRandomText(length) {
    // Caracteres disponíveis para o CAPTCHA
    let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
      result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
  }

  function validateCaptcha() {
    // Obtém o texto digitado pelo usuário
    let userInput = document.getElementById('captcha-input').value;
    
    // Obtém o texto do CAPTCHA gerado anteriormente
    let captchaText = sessionStorage.getItem('captcha');
    
    // Verifica se o texto digitado está correto
    if (userInput === captchaText) {
		document.getElementById('captcha-result').style.color = '#5f5';
      document.getElementById('captcha-result').innerText = 'CAPTCHA Success. Now you are allowed to search by leaks!';
	  document.getElementById("finalizar").disabled = false;
    } else {
		att+=1;
		if (att>= 3) {
			      document.getElementById('captcha-result').innerText = 'Você está tentando rápido demais!';
				 document.getElementById('captcha-result').style.color = '#f00';
				 document.getElementById("finalizar").disabled = true;

					return;
		}
		document.getElementById('captcha-result').style.color = '#e99';
      document.getElementById('captcha-result').innerText = 'CAPTCHA incorreto. Tente novamente.';
	  generateCaptcha();
    }
    
    // Limpa o campo de entrada
    document.getElementById('captcha-input').value = '';
  }

  // Inicializa o CAPTCHA quando a página carrega
  generateCaptcha();
</script>


</body>
</html>
