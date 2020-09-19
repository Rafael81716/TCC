<?php 
//criando a classe usuario

class Usuario{
    private $pdo;
    public $msgErro = "";// caso esteja vazio ta tudo certo
    //função publicas para ligar ao banco de dados
    public function conectar($nome, $host, $usuario, $senha)
    {
        //global significa que vai ter a mesma variavel em qualquer lugar
        global $pdo;
        //criando o pdo e evitando erros por meio do try
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha); 
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }  
    }

    public function cadastrar($nome, $matricula, $email, $senha)
    {
        global $pdo;
        //verificar se já existe o emial cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");//:e é o email que o usuario digitou
        $sql->bindValue(":e",$email);
        $sql->execute();
            //aqui iá conferir que o email no banco de dados já está cadastrado e ver se ja exite um id nele
        if ($sql->rowCount() > 0) {
            return false; //está casdastrado
        }else{
            //caso não cadastrado, cadastro
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, matricula, email, senha) VALUES (:n, :m, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":m",$matricula);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
        
    }				

    public function logar($email, $senha)
    {
        global $pdo;
        //verificar se o emial e senha estao cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE 
        email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
            //entre no sistema (sessao)
            // vai pegar os valores de id_usuario e transforma em um array no php
            $dado = $sql->fetch(); //transforma oq veio do banco de dados em array
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // cadastrado com sucesso 
        }else{
            return false;// não foi possivel logar
        }
    }
}

