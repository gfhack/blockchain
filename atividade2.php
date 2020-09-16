<?php

class Block {
    public $from;
    public $to;
    public $message;

    public $hash;
    public $previousHash;

    public function __construct(string $from, string $to, string $previousHash = "") {
        $this->from = $from;
        $this->to = $to;
        $this->message = "Origem: {$from}\nDestino: {$to}\nMensagem: Ola {$to}. Meu nome é {$from}.\n";
        $this->hash = hash("sha256", $this->message);
        $this->previousHash = $previousHash;
    }

    public function __toString() {
        return $this->message . "Hash: {$this->hash}\n" . "Hash anterior: {$this->previousHash}\n";
    }
}

$people = [
    'Chase',
    'Rennie',
    'Franklin',
    'Huynh',
    'England',
    'Lugo',
    'Rodrigues',
    'Betts',
    'Cummings',
    'Irwin',
    'Nixon',
    'Higgins',
    'Cook',
    'Ross',
    'Eaton',
    'Fountain',
];

$blocks = array();

for ($i=0; $i < sizeof($people) - 1; $i++) {
    $previousHash = ($i > 0)
        ? $blocks[$i - 1]->hash
        : "";
    
    array_push($blocks, new Block($people[$i], $people[$i+1], $previousHash));
}

foreach ($blocks as $index => $block) {
    echo "\nBloco: {$index}\n";
    echo $block;
}