<?php

class Block {
    public $from;
    public $to;
    public $message;

    public $hash;
    public $previousHash;

    public function __construct(string $from, string $to, string $previousHash = null) {
        $this->from = $from;
        $this->to = $to;
        $this->message = "Origem: {$from}\nDestino: {$to}\nMensagem: Ola {$to}. Meu nome é {$from}.\n";
        $this->hash = hash("sha256", $this->message);
        $this->previousHash = $previousHash;
    }
}

$block = new Block("Chase", "Rennie");

echo $block->message;