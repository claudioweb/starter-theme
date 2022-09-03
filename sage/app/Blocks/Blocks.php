<?php

/*
    Blocks
*/

namespace App\Blocks;

use \App\Blocks\Article; // Bloco de exemplo

class Blocks {

    public function __construct() {
        new Article(); // Bloco de exemplo
    }

}

new Blocks();
