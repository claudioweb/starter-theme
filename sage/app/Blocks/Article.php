<?php

namespace App\Blocks;

use WordPlate\Acf\Fields\PostObject;

class Article extends Block {

    protected $blockName = 'article';

    protected function createFields() {
        $this->fields = [
            PostObject::make('Artigo', 'article')
                ->instructions('Selecione um artigo')
                ->postTypes(['post'])
                ->returnFormat('id')
                ->required()
        ];
    }

}
