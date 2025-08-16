<?php

class Role {
    public $id;
    public $name;
    public $description;

    public function __construct(
        $name, 
        $description,
        $id = null, 
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->id = $id;
    }
}
