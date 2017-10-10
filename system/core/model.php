<?php

namespace system\core;

use system\core\import;

class model
{
    private $modelCollection = [];

    public function run($model, $namespace = null)
    {
        if (array_key_exists($model, $this->modelCollection)) {
            return $this->modelCollection[$model];
        } else {
            $db = import::model($model, $namespace);
            $this->modelCollection[$model] = $db;
            return $this->modelCollection[$model];
        }
    }

}