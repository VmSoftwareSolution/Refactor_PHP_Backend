<?php

class Payload {
    public $id;
    public $id_order;
    public $method;
    public $status;
    public $payment_at;
    
    public function __construct(
        int $id_order,
        $method,
        $status,
        $payment_at = null,
        ?int $id = null
    ) {
        $this->id_order     = $id_order;
        $this->method    = $method;
        $this->status     = $status;
        $this->payment_at = $payment_at ?? date('Y-m-d H:i:s');
        $this->id         = $id;
    }
}
