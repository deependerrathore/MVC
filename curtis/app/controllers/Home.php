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
        // $contacts1 = $db->find('contacts',[
        //     'conditions' => "fname = ?",
        //     'bind' => ['deepender'],
        //     'order' => "fname, lname",
        //     'limit' => 5
        // ]);
        $contacts2 = $db->findfirst('contacts',[
            'conditions' => ['id= ?'],
            'bind' => ['1'],
            
        ]);
        //dnd($db->get_columns('contacts'));
        dnd($contacts2);
        $this->view->render('home/index');
    }
}