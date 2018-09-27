<?php

class Home extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller,$action);
    }

    public function indexAction(){
        //die('Welcome to the home controller this is a indexAction'); 

        $db = DB::getInstance();
        $fields = [
            'fname' => 'Narender',
            'lname' => 'Rathore',
            'email' => 'naren@naren.com'
        ]; 
        
        $contacts = $db->insert('contacts',$fields);
        $this->view->render('home/index');
    }
}