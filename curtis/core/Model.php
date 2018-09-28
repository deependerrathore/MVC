<?php

class Model{
    protected  $_db, $_table , $_modelName , $_softDelete = false, $_columnsNames = [];
    public $id;

    public function __construct($table){
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->setColumnNames();
        $this->_modelName = str_replace(' ','',ucword(str_replace('_',' ',$this->_table))); //example user_sessions = UserSessions

    }

    protected function setColumnNames(){
        $columns = $this->get_columns();
        foreach ($columns as $column) {
            $this->_columnsNames[] = $column->Field;
            $this->{$columnName} = null;
        }
    }

    protected function get_columns(){
        return $this->_db->get_columns($this->_table);
    }

    public function find($params = []){
        $results = [];
        $resultsQuery = $this->_db->find($this->_table,$params);
        foreach($resultsQuery as $result){
            $obj = new $this->_modelName($this->_table);
            $obj->populateObjData($result);
            $results[] = $obj;
        }
        return $results;
    }
    public function findFirst($params = []){
        $resultQuery = $this->_db->findFirst($this->_table,$params);
        $result = new $this->_modelName($this->_table);
        $result->populateObjData($resultQuery);
        return $result;
    }
    public function findById($id){
        return $this->findFirst([
            'conditions' => ['id = ?'],
            'bind' => [$id]
        ])
    }
    protected function populateObjData($result){
        foreach($result as $key => $value){
            $this->$key = $value;
        }
    }
}