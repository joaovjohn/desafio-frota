<?php

namespace Application\Controller;

use Application\Entity\Veiculo;
use Application\Service\VeiculoService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

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
            $veiculoService->createVehicle($request->getPost()->toArray());
            return $this->redirect()->toRoute('veiculo');
        }

        return new ViewModel();
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