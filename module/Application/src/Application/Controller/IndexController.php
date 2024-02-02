<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {

        $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
        $veiculos = $veiculoService->getAll();

        $driverService = $this->getServiceLocator()->get('Application\Service\MotoristaService');
        $motoristas = $driverService->getAll();

        return new ViewModel(['veiculos' => $veiculos, 'motoristas' => $motoristas]);
    }
}
