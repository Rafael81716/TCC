<?php 
	require_once '../Classes/usuarios.php';
	$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-59">
						Cadastre-se
					</span>

					<div class="wrap-input100 validate-input" data-validate="Nome é necessário">
						<span class="label-input100">Nome Completo</span>
						<input class="input100" type="text" name="nome" placeholder="Nome..." maxlength="40">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Exemplo de e-mail válido: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="endereço de email..." maxlength="40">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Matricula obrigatoria">
						<span class="label-input100">Número de Matricula</span>
						<input class="input100" type="number" name="matricula" placeholder="número da matricula" maxlength="30">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Senha Obrigatória">
						<span class="label-input100">Senha</span>
						<input class="input100" type="password" name="senha" placeholder="*************" maxlength="20">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "repetir senha obrigatório">
						<span class="label-input100">Repita a senha</span>
						<input class="input100" type="password" name="confsenha" placeholder="*************" maxlength="20">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Eu concordo com os 
									<a href="#" class="txt2 hov1">
										Termos de uso
									</a>
								</span>
							</label>
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Cadastrar
							</button>
						</div>

						<a href="../Login/index.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Entrar
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
				<?php 
				// verificar se clicou no botao
				if(isset($_POST['nome']))
				{
					$nome = addslashes($_POST['nome']);
					$matricula = addslashes($_POST['matricula']);
					$email = addslashes($_POST['email']);
					$senha = addslashes($_POST['senha']);
					$confimarSenha = addslashes($_POST['confsenha']);
					//verificar se esta preenchido
					if (!empty($nome) && !empty($matricula) && !empty($email) && !empty($senha) && !empty($confimarSenha)) {
						$u->conectar ("projeto_tcc","localhost","root","");
						if ($u->msgErro == "") {//conferir se esta tudo certo
							//verificar se as senhas são iguais
							if ($senha == $confimarSenha) {
								if($u->cadastrar($nome, $matricula, $email, $senha)){
									echo "Cadastrado com Sucesso! Acesse para entrar!";
								}else{
									echo "email ja cadastrado";
								}
							}else{
								echo "Senha e confirmar senha não correspondem!";
							}
							
						}else{
							echo "Erro: ". $u->msgErro;
						}
					}else{
						echo "Preencha todos os campos!";
					}
				}

				?>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>