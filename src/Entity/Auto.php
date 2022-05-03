<?php

namespace App\Entity;

use App\Repository\AutoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutoRepository::class)]
class Auto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $marca;

    #[ORM\Column(type: 'string', length: 255)]
    private $modelo;

    #[ORM\Column(type: 'integer')]
    private $anio;

    #[ORM\Column(type: 'string', length: 255)]
    private $patente;

    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    #[ORM\ManyToOne(targetEntity: Propietario::class, inversedBy: 'autos')]
    #[ORM\JoinColumn(nullable: false)]
    private $propietario;

    #[ORM\OneToMany(mappedBy: 'auto', targetEntity: Transaccion::class, orphanRemoval: true)]
    private $transaccions;

    public function __construct()
    {
        $this->transaccions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(int $anio): self
    {
        $this->anio = $anio;

        return $this;
    }

    public function getPatente(): ?string
    {
        return $this->patente;
    }

    public function setPatente(string $patente): self
    {
        $this->patente = $patente;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPropietario(): ?Propietario
    {
        return $this->propietario;
    }

    public function setPropietario(?Propietario $propietario): self
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * @return Collection<int, Transaccion>
     */
    public function getTransaccions(): Collection
    {
        return $this->transaccions;
    }

    public function addTransaccion(Transaccion $transaccion): self
    {
        if (!$this->transaccions->contains($transaccion)) {
            $this->transaccions[] = $transaccion;
            $transaccion->setAuto($this);
        }

        return $this;
    }

    public function removeTransaccion(Transaccion $transaccion): self
    {
        if ($this->transaccions->removeElement($transaccion)) {
            // set the owning side to null (unless already changed)
            if ($transaccion->getAuto() === $this) {
                $transaccion->setAuto(null);
            }
        }

        return $this;
    }
}
