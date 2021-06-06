<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository{

    protected $model;

    public function __construct(){

        if($this->model instanceof Model) return;

        $classname = static::class;

        $basename = class_basename($classname);

        $modelbase = \str_replace("Repository","",$basename);

        $model = 'App\\Models\\'.$modelbase;

        $this->model = new $model;
        
    }

    public function getModel(){
       return $this->model;
    }

}