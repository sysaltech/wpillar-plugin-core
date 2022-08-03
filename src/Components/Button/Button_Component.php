<?php


namespace Plugin\Core\Components\Button;

use Plugin\Core\Abstractions\Abstract_Component;

class Button_Component extends Abstract_Component
{
    static function key(): string
    {
        return 'button';
    }

    function defaults(): array
    {
        return [
            'content' => 'Click Here',
            'attributes' => [
                'attr1' => 'attribute',
                'attr2' => 'attribute'
            ]
        ];
    }
}