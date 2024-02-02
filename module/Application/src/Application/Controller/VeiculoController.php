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
            $vehicleRequest = $request->getPost()->toArray();
            $vehicleRequest['ano'] = (int)$vehicleRequest['ano'];
            $veiculoService = $this->getServiceLocator()->get('Application\Service\VeiculoService');
            $newVehicle = $veiculoService->createVehicle($vehicleRequest);
            if ($newVehicle['success']) {
                return $this->redirect()->toRoute('veiculo', ['action' => 'index']);
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