<?php

namespace App\Blocks;

use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Location;

abstract class Block {

    protected $blockName = 'block';
    protected $fields = array();

    public function __construct() {
        $this->createFields();
        $this->createSettings();
    }

    protected function createSettings() {
        register_extended_field_group([
            'key'      => 'group_' . $this->blockName,
            'title'    => ' ',
            'fields'   => [
                Group::make('Configurações', $this->blockName . '_settings')
                    ->instructions('Configurações do bloco.')
                    ->layout('block')
                    ->fields($this->fields)
            ],
            'location' => [
                Location::if('block', 'acf/' . $this->blockName)
            ],
        ]);

        add_filter('sage/blocks/' . $this->blockName . '/data', function ($block) { // Do your thing here.
            return array_merge(
                $block,
                array(
                    'data' => get_field($this->blockName . '_settings'),
                )
            );
        });
    }

    abstract protected function createFields();

}
