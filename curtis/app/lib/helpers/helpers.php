<?php

function dnd($data){ // dump and die
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sanatize($dirtyValue){
    return htmlentities($dirtyValue,ENT_QUOTES,'uft-8');
}

function currentUser(){
    return Users::currentLoggedInUser();
}