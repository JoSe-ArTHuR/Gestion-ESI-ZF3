<?php

namespace Etudiant;

// Add these import statements:
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    // getConfig() method is here

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\EtudiantTable::class => function($container) {
                    $tableGateway = $container->get(Model\EtudiantTableGateway::class);
                    return new Model\EtudiantTable($tableGateway);
                },
                Model\EtudiantTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Etudiant());
                    return new TableGateway('etudiant', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
   {
       return [
           'factories' => [
               Controller\EtudiantController::class => function($container) {
                   return new Controller\EtudiantController(
                       $container->get(Model\EtudiantTable::class)
                   );
               },
           ],
       ];
   }
}

?>
