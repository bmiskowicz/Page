<?php
    require('Models/Model.php');
    require('Views/View.php');

    class myController{
        public $model;
        public $view;

        function __construct(){
            $this->model = new myModel();
            $this->view = new myView();
        }

        function getData(){
            return $this->model->getData();
        }

        function readData(){
            $i=0;
            while(!feof($this->model->file)){
                $linia = fgets($this->model->file);
                $dane = explode(",",$linia);
                $this->model->data[$i++] = explode(":",$dane[0])[1];
            }
            $taryfy = array();
            $dane = array();
            foreach($this->getData() as $taryfa){
                if(!in_array($taryfa,$taryfy)){
                    $taryfy[sizeof($taryfy)]=$taryfa;
                    $dane[sizeof($dane)]=array($taryfa,1);
                }
                else{
                    foreach($dane as $d){
                        if($d[0]==$taryfa){
                            $dane[array_search($d,$dane)][1]++;
                        }
                    }
                }
            }
            $this->model->setData($dane);
        }
    }
    $controller = new myController();
    $controller->readData();
    $controller->view->setData($controller->getData());
    $controller->view->showChart();
    fclose($controller->model->file);
?>