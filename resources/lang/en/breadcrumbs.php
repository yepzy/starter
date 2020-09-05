<?php

return [

    'orphan' => [
        'index' => ':entity > Management',
        'create' => ':entity > Creation',
        'edit' => ':entity > :detail > Edition',
    ],

    'parent' => [
        'index' => ':parent > :entity > Management',
        'create' => ':parent > :entity > Creation',
        'edit' => ':parent > :entity > :detail > Edition',
    ],

];
