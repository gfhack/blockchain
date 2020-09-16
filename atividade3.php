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

// gerando blocos
for ($i=0; $i < sizeof($people) - 1; $i++) {
    $previousHash = ($i > 0)
        ? $blocks[$i - 1]->hash
        : "";
    
    array_push($blocks, new Block($people[$i], $people[$i + 1], $previousHash));
}

// criando arquivos
foreach ($blocks as $index => $block) {
    $blockfile = fopen("blocos/bloco_{$index}.txt", 'w');
    fwrite($blockfile, $block);
    fclose($blockfile);
}

// validando
foreach ($blocks as $index => $block) {
    $blockfile = fopen("blocos/bloco_{$index}.txt", 'r');
    
    echo "\nBloco: {$index}\n";

    while ($line = fgets($blockfile)) {
        echo $line;

        if (strpos($line, $block->hash) !== false) {
            echo "Hash válida\n";
        }

        if ($index > 0 && strpos($line, $blocks[$index - 1]->hash) !== false) {
            echo "Hash anterior válida\n";
        }
    }

    fclose($blockfile);
}