<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Motorista as MotoristaEntity;

class MotoristaService
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getDriver(int $id) : array
    {
        $driver = $this->em->getRepository(MotoristaEntity::class)->find($id);

        if (method_exists($driver, 'toArray')) {
            return $driver->toArray();
        }

        return [
            'id' => $driver->getId(),
            'nome' => $driver->getNome(),
            'rg' => $driver->getRg(),
            'cpf' => $driver->getCpf(),
            'telefone' => $driver->getTelefone(),
            'veiculoId' => $driver->getVeiculoID(),
        ];
    }

    public function getAll() : array
    {
        $drivers = $this->em->getRepository(MotoristaEntity::class)->findAll();
        $driversArray = [];
        foreach ($drivers as $driver) {
            if (method_exists($driver, 'toArray')) {
                $driversArray[] = $driver->toArray();
            } else {
                $driversArray[] = [
                    'id' => $driver->getId(),
                    'nome' => $driver->getNome(),
                    'rg' => $driver->getRg(),
                    'cpf' => $driver->getCpf(),
                    'telefone' => $driver->getTelefone(),
                    'veiculoID' => $driver->getVeiculoID(),
                ];
            }
        }
        return $driversArray;
    }

    public function createDriver(array $driver) : array
    {
        try {
            $this->validateDriver($driver);

            $veiculoRepository = $this->em->getRepository('Application\Entity\Veiculo');
            $veiculo = $veiculoRepository->find($driver['veiculo']);
            if (empty($veiculo)) {
                return [
                    'success' => false,
                    'message' => 'Veículo não encontrado',
                ];
            }

            $motorista = new MotoristaEntity();
            $motorista->setNome($driver['nome']);
            $motorista->setRg($driver['rg']);
            $motorista->setCpf($driver['cpf']);
            $motorista->setTelefone($driver['telefone']);
            $motorista->setVeiculoID($veiculo);

            $this->em->persist($motorista);
            $this->em->flush();

            return [
                'success' => true,
                'message' => 'Motorista criado com sucesso',
            ];

        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => 'Erro ao criar motorista: ' . $e->getMessage(),
            ];
        }
    }

    public function updateDriver(array $driverUpdate) : array
    {
        try {
            $motorista = $this->em->getRepository(MotoristaEntity::class)->find($driverUpdate['id']);
            if (empty($motorista)) {
                return [
                    'success' => false,
                    'message' => 'Motorista não encontrado',
                ];
            }

            $motorista->setNome($driverUpdate['nome'] ?? $motorista->getNome());
            $motorista->setRg($driverUpdate['rg'] ?? $motorista->getRg());
            $motorista->setCpf($driverUpdate['cpf'] ?? $motorista->getCpf());
            $motorista->setTelefone($driverUpdate['telefone'] ?? $motorista->getTelefone());
            $motorista->setVeiculoID($driverUpdate['veiculoId'] ?? $motorista->getVeiculoID());

            $this->em->persist($motorista);
            $this->em->flush();

            return [
                'success' => true,
                'message' => 'Motorista atualizado com sucesso',
            ];

        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => 'Erro ao atualizar motorista: ' . $e->getMessage(),
            ];
        }
    }

    public function deleteDriver(int $idDriver) : array
    {
        try {
            $driver = $this->em->getRepository(MotoristaEntity::class)->find($idDriver);

            if (empty($driver)) {
                return [
                    'success' => false,
                    'message' => 'Motorista não encontrado',
                ];
            }

            $this->em->remove($driver);
            $this->em->flush();

            return [
                'success' => true,
                'message' => 'Motorista deletado com sucesso',
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao deletar motorista: ' . $e->getMessage(),
            ];
        }
    }

    private function validateDriver(array $driver)
    {
        if(empty($driver['nome'])) {
            throw new \Exception('Nome do motorista é obrigatório');
        }
        if (empty($driver['rg'])) {
            throw new \Exception('RG do motorista é obrigatório');
        }
        if (empty($driver['cpf'])) {
            throw new \Exception('CPF do motorista é obrigatório');
        }
        return true;
    }
}