<?php

namespace Esi;

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
                Model\EsiTable::class => function($container) {
                    $tableGateway = $container->get(Model\EsiTableGateway::class);
                    return new Model\EsiTable($tableGateway);
                },
                Model\EsiTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Esi());
                    return new TableGateway('bibliotheque', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
   {
       return [
           'factories' => [
               Controller\EsiController::class => function($container) {
                   return new Controller\EsiController(
                       $container->get(Model\EsiTable::class)
                   );
               },
           ],
       ];
   }
}

?>
