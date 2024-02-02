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

        return new ViewModel(['motoristas' => $drivers]);
    }

    public function createAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $driverService = $this->getServiceLocator()->get('Application\Service\MotoristaService');
            $newDriver = $driverService->createDriver($request->getPost()->toArray());
            if ($newDriver['suceess']) {
                $this->view->setVariable('message', $newDriver['message']);
                return $this->redirect()->toRoute('motorista');
            }
        }
        return new ViewModel('message', $newDriver['message']);
    }
}