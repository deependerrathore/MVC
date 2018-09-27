<?php

class Home extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller,$action);
    }

    public function indexAction(){
        //die('Welcome to the home controller this is a indexAction'); 

        $db = DB::getInstance();
        $sql = 'SELECT * from contacts';
        $contacts = $db->query($sql);
        dnd($contacts);
        $this->view->render('home/index');
    }
}