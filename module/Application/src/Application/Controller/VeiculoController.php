<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VeiculoController extends AbstractActionController
{

    public function indexAction()
    {
        $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
        $vehicles = $veiculoService->getAll();

        return new ViewModel(['veiculo' => $vehicles]);
    }

    public function createAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
            $newVehicle = $veiculoService->createVehicle($request->getPost()->toArray());
            if ($newVehicle['success']) {
                $this->view->setVariable('message', $newVehicle['message']);
                return $this->redirect()->toRoute('veiculo');
            }
        }

        return new ViewModel('message', $newVehicle['message']);
    }

    public function updateAction()
    {
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');

        if ($request->isPost()) {
            $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
            $veiculoService->updateVehicle($id, $request->getPost()->toArray());
            return $this->redirect()->toRoute('veiculo');
        }

        $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
        $vehicle = $veiculoService->getVehicle($id);

        return new ViewModel(['veiculo' => $vehicle]);
    }

    public function deleteAction()
    {


    }
}