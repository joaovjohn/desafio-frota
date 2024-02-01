<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {

//        $vehicle = [
//            'id' => 2,
//            'placa' => 'ABC1234',
//            'renavam' => '123456789',
//            'modelo' => 'Golf',
//            'marca' => 'Volkswagen',
//            'ano' => 2010,
//            'cor' => 'Amarelo',
//        ];
//
//        $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
//        $vei = $veiculoService->updateVehicle($vehicle);
//
//
//        return new ViewModel();

    }

    public function veiculoAction()
    {
        return new ViewModel();
    }

    public function motoristaAction()
    {
        return new ViewModel();
    }

}
