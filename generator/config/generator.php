<?php

return [
    'Controller' => [
        'source' => 'controller.php',
        'destination' => './output/ARG1.php',
        'replace' => [
            'class'    => 'ARG1|ucfirst',
            'comments' => 'Code goes here.',
        ],
    ],
];
