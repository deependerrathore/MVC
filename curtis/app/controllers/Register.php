<?php

class Register extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller,$action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction(){
        
        $validationn = new Validate();

        if ($_POST) {
            //form validation
            $validationn->check($_POST,[
                'username' => [
                    'display' => "Username",
                    'required' => true
                ],
                'password' => [
                    'display' => "Password",
                    'required' => true
                ]
            ]);
            if($validationn->passed()){
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if ($user && password_verify(Input::get('password'),$user->password)) {
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                }
            }
        }
        $this->view->render('register/login');
    }


}