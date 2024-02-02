<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="motoristas")
 */
class Motorista
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $rg;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     */
    protected $cpf;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $telefone;

    /**
     * @ORM\ManyToOne(targetEntity="Veiculo")
     * @ORM\JoinColumn(name="veiculoId", referencedColumnName="id")
     * @var Veiculo
     */
    protected $veiculoID;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getVeiculoID()
    {
        return $this->veiculoID;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setVeiculoID($veiculoID)
    {
        $this->veiculoID = $veiculoID;
    }
}