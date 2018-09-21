<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
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
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subcategories", mappedBy="category_id")
     */
    private $subcategory;

    public function __construct()
    {
        $this->subcategory = new ArrayCollection();
    }

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Subcategories[]
     */
    public function getSubcategory(): Collection
    {
        return $this->subcategory;
    }

    public function addSubcategory(Subcategories $subcategory): self
    {
        if (!$this->subcategory->contains($subcategory)) {
            $this->subcategory[] = $subcategory;
            $subcategory->setCategoryId($this);
        }

        return $this;
    }

    public function removeSubcategory(Subcategories $subcategory): self
    {
        if ($this->subcategory->contains($subcategory)) {
            $this->subcategory->removeElement($subcategory);
            // set the owning side to null (unless already changed)
            if ($subcategory->getCategoryId() === $this) {
                $subcategory->setCategoryId(null);
            }
        }

        return $this;
    }
}
