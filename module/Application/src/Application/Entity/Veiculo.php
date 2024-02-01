<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="veiculos")
 */
class Veiculo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $placa;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     *
     */
    protected $renavam;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $modelo;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $marca;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ano;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $cor;

    public function getId()
    {
        return $this->id;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function getRenavam()
    {
        return $this->renavam;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    public function setRenavam($renavam)
    {
        $this->renavam = $renavam;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }
}