<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $itemNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $manufacturer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productGroup = null;

    #[ORM\Column ( nullable: true)]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $inventory = null;

    #[ORM\Column(length: 255)]
    private ?string $estimatedLeadTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quality = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $ean = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getItemNumber(): ?string
    {
        return $this->itemNumber;
    }

    public function setItemNumber(string $itemNumber): static
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getProductGroup(): ?string
    {
        return $this->productGroup;
    }

    public function setProductGroup(?string $productGroup): static
    {
        $this->productGroup = $productGroup;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getInventory(): ?int
    {
        return $this->inventory;
    }

    public function setInventory(int $inventory): static
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getEstimatedLeadTime(): ?string
    {
        return $this->estimatedLeadTime;
    }

    public function setEstimatedLeadTime(string $estimatedLeadTime): static
    {
        $this->estimatedLeadTime = $estimatedLeadTime;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(?string $quality): static
    {
        $this->quality = $quality;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

public function setEan(?string $ean): static
    {
        $this->ean = $ean;

        return $this;
    }
}
