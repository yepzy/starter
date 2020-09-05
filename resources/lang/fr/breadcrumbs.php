<?php

return [

    'orphan' => [
        'index' => ':entity > Gestion',
        'create' => ':entity > Ajout',
        'edit' => ':entity > :detail > Édition',
    ],

    'parent' => [
        'index' => ':parent > :entity > Gestion',
        'create' => ':parent > :entity > Ajout',
        'edit' => ':parent > :entity > :detail > Édition',
    ],

];
