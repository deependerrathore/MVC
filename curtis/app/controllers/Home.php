<?php

class Home extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller,$action);
    }

    public function indexAction(){
        //die('Welcome to the home controller this is a indexAction'); 

        $db = DB::getInstance();
        $fields = [
            'fname' => 'Indu',
            'lname' => 'Rathore',
            'email' => 'indu@indu.com'
        ]; 
        
        $contacts = $db->delete('contacts',2);
        $this->view->render('home/index');
    }
}