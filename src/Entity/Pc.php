<?php

namespace App\Entity;

use App\Repository\PcRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PcRepository::class)]
class Pc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $model = null;

    #[ORM\Column(length: 15)]
    private ?string $os = null;

    #[ORM\Column]
    private ?int $RAM = null;

    #[ORM\Column]
    private ?int $HDD = null;

    #[ORM\Column(length: 255)]
    private ?string $cpu = null;

    #[ORM\Column(length: 50)]
    private ?string $gpu = null;

    #[ORM\Column]
    private ?bool $active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(string $os): static
    {
        $this->os = $os;

        return $this;
    }

    public function getRAM(): ?int
    {
        return $this->RAM;
    }

    public function setRAM(int $RAM): static
    {
        $this->RAM = $RAM;

        return $this;
    }

    public function getHDD(): ?int
    {
        return $this->HDD;
    }

    public function setHDD(int $HDD): static
    {
        $this->HDD = $HDD;

        return $this;
    }

    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    public function setCpu(string $cpu): static
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getGpu(): ?string
    {
        return $this->gpu;
    }

    public function setGpu(string $gpu): static
    {
        $this->gpu = $gpu;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }
}
