<?php

namespace TimeNormalize;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'filters' => [
        'factories' => [
            Filter\Time::class => InvokableFactory::class,
        ],
        'aliases' => [
            'Time' => Filter\Time::class,
        ],
    ],
    'validators' => [
        'factories' => [
            Validator\Time::class => InvokableFactory::class,
        ],
        'aliases' => [
            'Time' => Validator\Time::class,
        ],
    ],
];
