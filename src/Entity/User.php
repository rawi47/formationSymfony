<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="user")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Doccument", mappedBy="user")
     */
    private $doccuments;

    public function __construct ()
    {
        $this -> products = new ArrayCollection ();
        $this->doccuments = new ArrayCollection();
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

     /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setUser($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getUser() === $this) {
                $product->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Doccument[]
     */
    public function getDoccuments(): Collection
    {
        return $this->doccuments;
    }

    public function addDoccument(Doccument $doccument): self
    {
        if (!$this->doccuments->contains($doccument)) {
            $this->doccuments[] = $doccument;
            $doccument->setUser($this);
        }

        return $this;
    }

    public function removeDoccument(Doccument $doccument): self
    {
        if ($this->doccuments->contains($doccument)) {
            $this->doccuments->removeElement($doccument);
            // set the owning side to null (unless already changed)
            if ($doccument->getUser() === $this) {
                $doccument->setUser(null);
            }
        }

        return $this;
    }
}
