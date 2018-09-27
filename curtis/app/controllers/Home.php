<?php

class Home extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller,$action);
    }

    public function indexAction(){
        //die('Welcome to the home controller this is a indexAction'); 

        $db = DB::getInstance();
        $fields = [
            'fname' => 'Datar',
            'lname' => 'rathore',
            'email' => 'lata@lata.com'
        ]; 
        
        //$contacts = $db->query('SELECT * FROM contacts')->count();
        $contacts = $db->query('SELECT * FROM contacts')->first();
        dnd($contacts);
        //dnd($db->get_columns('contacts'));
        
        $this->view->render('home/index');
    }
}