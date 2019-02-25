<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeverageRepository")
 */
class Beverage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $price;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $beverage_color;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $beverage_type_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBeverageColor(): ?string
    {
        return $this->beverage_color;
    }

    public function setBeverageColor(string $beverage_color): self
    {
        $this->beverage_color = $beverage_color;

        return $this;
    }

    public function getBeverageTypeId(): ?int
    {
        return $this->beverage_type_id;
    }
    
    public function setBeverageTypeId(int $beverage_type_id): self
    {
        $this->beverage_type_id = $beverage_type_id;
        
        return $this;
    }

    /**
     * @var beverageType 
     * 
     * @ORM\ManyToOne(targetEntity="BeverageType", inversedBy="beverage")
     * @ORM\JoinColumn(name="beverage_type_id", referencedColumnName="id")
     */
    protected $beverageType;
     
    /**
     * Узнать, к какому дому относится данный юзер (когда уже связаны)
     * 
     * @return beverageType
     */
    public function getBeverageType(): beverageType
    {
        return $this->beverageType;
    }

}
