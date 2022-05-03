<?php

namespace App\Entity;

use App\Repository\TransaccionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransaccionRepository::class)]
class Transaccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: Auto::class, inversedBy: 'transaccions')]
    #[ORM\JoinColumn(nullable: false)]
    private $auto;

    #[ORM\OneToMany(mappedBy: 'transaccion', targetEntity: Items::class, orphanRemoval: true)]
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getAuto(): ?Auto
    {
        return $this->auto;
    }

    public function setAuto(?Auto $auto): self
    {
        $this->auto = $auto;

        return $this;
    }

    /**
     * @return Collection<int, Items>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Items $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setTransaccion($this);
        }

        return $this;
    }

    public function removeItem(Items $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getTransaccion() === $this) {
                $item->setTransaccion(null);
            }
        }

        return $this;
    }
}
