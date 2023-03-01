<?php

namespace App\Entity;

use App\Repository\PaisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaisesRepository::class)
 */
class Paises
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $abreviatura;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaCreacion;

    /**
     * @ORM\OneToMany(targetEntity=Ciudades::class, mappedBy="paisId")
     */
    private $ciudades;

    public function __construct()
    {
        $this->ciudades = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAbreviatura(): ?string
    {
        return $this->abreviatura;
    }

    public function setAbreviatura(string $abreviatura): self
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * @return Collection<int, Ciudades>
     */
    public function getCiudades(): Collection
    {
        return $this->ciudades;
    }

    public function addCiudade(Ciudades $ciudade): self
    {
        if (!$this->ciudades->contains($ciudade)) {
            $this->ciudades[] = $ciudade;
            $ciudade->setPaisId($this);
        }

        return $this;
    }

    public function removeCiudade(Ciudades $ciudade): self
    {
        if ($this->ciudades->removeElement($ciudade)) {
            // set the owning side to null (unless already changed)
            if ($ciudade->getPaisId() === $this) {
                $ciudade->setPaisId(null);
            }
        }

        return $this;
    }

    public function toArray()
    {
        $ciudades = [];
        foreach ($this->ciudades as $ciudad) {
            array_push($ciudades, $ciudad->toArray());
        }

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'abreviatura' => $this->abreviatura,
            'fechaCreacion' => $this->fechaCreacion->format('Y-m-d H:i:s'),
            'estado' => $this->estado,
            'ciudades' => $ciudades
        ];
    }
   
}
