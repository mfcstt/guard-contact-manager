<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'password' => ['required']
    ], $_POST);

    if ($validacao->naoPassou('login')) {
        header('location: /login');
        exit();
    }

    $usuario  = $database->query(
        query: "SELECT * FROM USUARIOS WHERE email = :email",
        class: Usuario::class,
        params: ['email' => $email]
    )->fetch();

    // dd($usuario);

    if ($usuario) {

        if (!password_verify($password, $usuario->password)) {
            flash()->push('validacoes_login', ['Usuario ou senha estão incorretos!']);
            header('location: /login');
            exit();
        }


        $_SESSION['auth'] = $usuario;

        flash()->push('mensagem', "Seja bem vindo " . $usuario->nome . "!");
        // $_SESSION['Mensagem']= "Seja bem vindo " . $usuario->nome . "!";
        header('location: /');

        exit();
    }
}




view('login');
