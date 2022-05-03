<?php

namespace App\Entity;

use App\Repository\PropietarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropietarioRepository::class)]
class Propietario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\OneToMany(mappedBy: 'propietario', targetEntity: Auto::class, orphanRemoval: true)]
    private $autos;

    public function __construct()
    {
        $this->autos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Auto>
     */
    public function getAutos(): Collection
    {
        return $this->autos;
    }

    public function addAuto(Auto $auto): self
    {
        if (!$this->autos->contains($auto)) {
            $this->autos[] = $auto;
            $auto->setPropietario($this);
        }

        return $this;
    }

    public function removeAuto(Auto $auto): self
    {
        if ($this->autos->removeElement($auto)) {
            // set the owning side to null (unless already changed)
            if ($auto->getPropietario() === $this) {
                $auto->setPropietario(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre.' '.$this->apellido;
    }
}
