<?php

namespace Etudiant;

use Zend\Router\Http\Segment;
use Etudiant\Controller\EtudiantController;


return [

    // The following section is new and should be added to your file:
   'router' => [
       'routes' => [
           'etudiant' => [
               'type'    => Segment::class,
               'options' => [
                   'route' => '/etudiant[/:action[/:id]]',
                   'constraints' => [
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                       'id'     => '[0-9]+',
                   ],
                   'defaults' => [
                       'controller' => Controller\EtudiantController::class,
                       'action'     => 'index',
                   ],
               ],
           ],
       ],
   ],

    'view_manager' => [
        'template_path_stack' => [
            'etudiant' => __DIR__ . '/../view',
        ],
    ],
];

 ?>
