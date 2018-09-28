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
}