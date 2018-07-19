<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TickesRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="datetime")
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_completado", type="datetime")
     */
    private $fechaCompletado;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="ticketsAsignado")
     */
    private $usuarioAsignado;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=11)
     */
    private $estado;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     *
     * @return Ticket
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return \DateTime
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Ticket
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCompletado
     *
     * @param \DateTime $fechaCompletado
     *
     * @return Ticket
     */
    public function setFechaCompletado($fechaCompletado)
    {
        $this->fechaCompletado = $fechaCompletado;

        return $this;
    }

    /**
     * Get fechaCompletado
     *
     * @return \DateTime
     */
    public function getFechaCompletado()
    {
        return $this->fechaCompletado;
    }


    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Ticket
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return int
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param int $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getUsuarioAsignado()
    {
        return $this->usuarioAsignado;
    }

    /**
     * @param mixed $usuarioAsignado
     */
    public function setUsuarioAsignado($usuarioAsignado)
    {
        $this->usuarioAsignado = $usuarioAsignado;
    }

}

