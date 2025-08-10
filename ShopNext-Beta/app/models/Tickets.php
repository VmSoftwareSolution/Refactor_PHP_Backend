<?php

class Tickets {
    public $id;
    public $tittle;
    public $message;
    public $priority;
    public $status;
    public $id_person;
    public $create_at;
    
    public function __construct(
        $tittle,
        $message,
        $priority,
        $status,
        int $id_person,
        $created_at = null,
        ?int $id = null
    ) {
        $this->tittle     = $tittle;
        $this->message    = $message;
        $this->priority   = $priority;
        $this->status     = $status;
        $this->id_person  = $id_person;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->id         = $id;
    }
}
