<?php

namespace App\Entity;

use App\Repository\CiudadesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CiudadesRepository::class)
 */
class Ciudades
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
     * @ORM\Column(type="string", length=3)
     */
    private $codigoIata;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Paises::class, inversedBy="ciudades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paisId;

    /**
     * @ORM\OneToMany(targetEntity=Usuarios::class, mappedBy="ciudad")
     */
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
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

    public function getCodigoIata(): ?string
    {
        return $this->codigoIata;
    }

    public function setCodigoIata(string $codigoIata): self
    {
        $this->codigoIata = $codigoIata;

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

    public function getPaisId(): ?Paises
    {
        return $this->paisId;
    }

    public function setPaisId(?Paises $paisId): self
    {
        $this->paisId = $paisId;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'codigoIata' => $this->codigoIata,
            'estado' => $this->estado
        ];
    }

    /**
     * @return Collection<int, Usuarios>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuarios $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setCiudad($this);
        }

        return $this;
    }

    public function removeUsuario(Usuarios $usuario): self
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getCiudad() === $this) {
                $usuario->setCiudad(null);
            }
        }

        return $this;
    }
}
