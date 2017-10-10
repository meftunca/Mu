<?php

namespace app\controller;
use system\core\view;
use system\core\model;
use system\libary\request;
use system\libary\form as form;
class deneme{

    public function index()
    {

       $model = new model;
       echo $model->run("deneme")->post("1321");
        $data=["title"=>"deneme"];
        view::render("first",$data);
    }

    public function page()
    {
        echo 'page';
    }

    public function view($id)
    {
        echo $id;
    }

}

