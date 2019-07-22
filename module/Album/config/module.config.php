<?php

namespace Album;

use Zend\Router\Http\Segment;
use Album\Controller\AlbumController;


return [

    // The following section is new and should be added to your file:
   'router' => [
       'routes' => [
           'album' => [
               'type'    => Segment::class,
               'options' => [
                   'route' => '/album[/:action[/:id]]',
                   'constraints' => [
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                       'id'     => '[0-9]+',
                   ],
                   'defaults' => [
                       'controller' => Controller\AlbumController::class,
                       'action'     => 'index',
                   ],
               ],
           ],
       ],
   ],

    // 'view_manager' => [
    //     'template_path_stack' => [
    //         'album' => __DIR__ . '/../view',
    //     ],
    // ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'album/album/index' => __DIR__ . '/../view/album/album/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

 ?>
