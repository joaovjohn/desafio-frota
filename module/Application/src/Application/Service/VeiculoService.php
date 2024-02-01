<?php
namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Veiculo as VeiculoEntity;

class VeiculoService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getVehicle(int $id) : array
    {
        $vehicle = $this->em->getRepository(VeiculoEntity::class)->find($id);

        if (method_exists($vehicle, 'toArray')) {
            return $vehicle->toArray();
        }

        return [
            'id' => $vehicle->getId(),
            'placa' => $vehicle->getPlaca(),
            'renavam' => $vehicle->getRenavam(),
            'modelo' => $vehicle->getModelo(),
            'marca' => $vehicle->getMarca(),
            'ano' => $vehicle->getAno(),
            'cor' => $vehicle->getCor(),
        ];
    }

    public function createVehicle(array $vehicle) : array
    {
        try {
            $this->validateVehicle($vehicle);

            $veiculo = new VeiculoEntity();
            $veiculo->setPlaca($vehicle['placa']);
            $veiculo->setRenavam($vehicle['renavam'] ?? null);
            $veiculo->setModelo($vehicle['modelo']);
            $veiculo->setMarca($vehicle['marca']);
            $veiculo->setAno($vehicle['ano']);
            $veiculo->setCor($vehicle['cor']);

            $this->em->persist($veiculo);
            $this->em->flush();

            return [
                'success' => true,
                'message' => 'Veículo criado com sucesso',
            ];

        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => 'Erro ao criar veículo: ' . $e->getMessage(),
            ];
        }
    }

    public function updateVehicle(array $vehicleUpdate) : array
    {
        try {

            $vehicle = $this->em->getRepository(VeiculoEntity::class)->find($vehicleUpdate['id']);

            if (empty($vehicle)) {
                return [
                    'success' => false,
                    'message' => 'Veículo não encontrado',
                ];
            }

            $vehicle->setPlaca($vehicleUpdate['placa'] ?? $vehicle->getPlaca());
            $vehicle->setRenavam($vehicleUpdate['renavam'] ?? $vehicle->getRenavam());
            $vehicle->setModelo($vehicleUpdate['modelo'] ?? $vehicle->getModelo());
            $vehicle->setMarca($vehicleUpdate['marca'] ?? $vehicle->getMarca());
            $vehicle->setAno($vehicleUpdate['ano'] ?? $vehicle->getAno());
            $vehicle->setCor($vehicleUpdate['cor'] ?? $vehicle->getCor());

            $this->em->persist($vehicle);
            $this->em->flush();

            return [
                'success' => true,
                'message' => 'Veículo atualizado com sucesso',
            ];

        }catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao atualizar veículo: ' . $e->getMessage(),
            ];
        }
    }

    public function deleteVehicle($vehicle)
    {
    }

    public function getAll()
    {
    }



    private function validateVehicle(array $vehicle)
    {

        if (empty($vehicle['placa']) || strlen($vehicle['placa']) > 7) {
            throw new \Exception('Placa inválida');
        }

        if (empty($vehicle['modelo']) || strlen($vehicle['modelo']) > 20) {
            throw new \Exception('Modelo inválido');
        }

        if (empty($vehicle['marca']) || strlen($vehicle['marca']) > 20) {
            throw new \Exception('Marca inválida');
        }

        if (empty($vehicle['ano']) || !is_int($vehicle['ano'])) {
            throw new \Exception('Ano inválido');
        }

        if (empty($vehicle['cor']) || strlen($vehicle['cor']) > 20) {
            throw new \Exception('Cor inválida');
        }
        return true;
    }
}