<?php 

namespace app\controllers;

class Login
{
    public function index()
    {
        return [
            'view' => 'login.php',
            'data' => ['title' => 'Login']
        ];
    }

    public function store()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = strip_tags($_POST['password']);

        if(empty($email) || empty($password))
        {
            return setMessageAndRedirect('message','Usuário ou senha estão incorreto','/login');
        }

        $user = findBy('users','email',$email);

        if(!$user)
        {
            return setMessageAndRedirect('message','Usuário ou senha estão incorreto','/login');
        }

        if(!password_verify($password, $user->password))
        {
            return setMessageAndRedirect('message','Usuário ou senha estão incorreto','/login');

        }

        $_SESSION[LOGGED] = $user;
        return redirect('/');
    }

    public function destroy()
    {
        unset($_SESSION[LOGGED]);
        return redirect('/');
    }

}