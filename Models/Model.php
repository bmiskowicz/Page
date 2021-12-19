<?php
    class myModel{
        public $data;
        public $file;
        
        function __construct(){
            $this->data = array();
            $this->file=@fopen(".\cena.txt", "r");
        }

        function getData(){
            return $this->data;
        }

        function getFile(){
            return $this->file;
        }

        function setData($data){
            $this->data=$data;
        }
    }
?>