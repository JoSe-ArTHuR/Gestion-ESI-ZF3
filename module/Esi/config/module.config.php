<?php

namespace Esi;

use Zend\Router\Http\Segment;
use Esi\Controller\EsiController;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'accueil' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'accueil',
                    ],
                ],
            ],
            'accueil' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/accueil[/:action]',
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'accueil',
                    ],
                ],
            ],
            'ecole' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/ecole[/:action]',
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'ecole',
                    ],
                ],
            ],
            'admission' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admission[/:action]',
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'admission',
                    ],
                ],
            ],
            'etudiant' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/etudiant[/:action]',
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'etudiant',
                    ],
                ],
            ],
            'bibliotheque' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/bibliotheque[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\EsiController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    // 'controllers' => [
    //     'factories' => [
    //         Controller\EsiController::class => InvokableFactory::class,
    //     ],
    // ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'esi/esi/accueil' => __DIR__ . '/../view/esi/esi/accueil.phtml',
            'esi/esi/ecole' => __DIR__ . '/../view/esi/esi/ecole.phtml',
            'esi/esi/admission' => __DIR__ . '/../view/esi/esi/admission.phtml',
            'esi/esi/etudiant' => __DIR__ . '/../view/esi/esi/etudiant.phtml',
            'esi/esi/index' => __DIR__ . '/../view/esi/esi/index.phtml',
        ],
        'template_path_stack' => [
            // __DIR__ . '/../view',
            'bibliotheque' => __DIR__ . '/../view',
        ],
    ],
];

//
// return [
//
//     // The following section is new and should be added to your file:
//    'router' => [
//        'routes' => [
//            'bibliotheque' => [
//                'type'    => Segment::class,
//                'options' => [
//                    'route' => '/bibliotheque[/:action[/:id]]',
//                    'constraints' => [
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[0-9]+',
//                    ],
//                    'defaults' => [
//                        'controller' => Controller\EsiController::class,
//                        'action'     => 'index',
//                    ],
//                ],
//            ],
//        ],
//    ],

//    'view_manager' => [
//
//        'template_path_stack' => [
//            __DIR__ . '/../view',
//        ],
//    ],
//  ];
