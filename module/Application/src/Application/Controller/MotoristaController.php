<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class MotoristaController extends AbstractActionController
{

    public function indexAction()
    {
        $driverService = $this->getServiceLocator()->get('Application\Service\MotoristaService');
        $drivers = $driverService->getAll();

        $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
        $vehicles = $veiculoService->getAll();

        return new ViewModel(['motoristas' => $drivers, 'veiculos' => $vehicles]);
    }

    public function createAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $driverService = $this->getServiceLocator()->get('Application\Service\MotoristaService');
            $newDriver = $driverService->createDriver($request->getPost()->toArray());
            if ($newDriver['suceess']) {
                $this->flashMessenger()->addSuccessMessage($newDriver['message']);
            } else {
                $this->flashMessenger()->addErrorMessage($newDriver['message']);
            }
        }
        return $this->redirect()->toRoute('motorista', ['action' => 'index']);
    }
}