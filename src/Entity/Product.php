<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category ;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="products")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Taxe", inversedBy="products")
     */
    private $taxes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Depot", inversedBy="products")
     */
    private $depots;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Doccument", mappedBy="product")
     */
    private $doccuments;

    public function __construct ()
    {
        $this -> taxes = new ArrayCollection ();
        $this->depots = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory () : ? Category
    {
        return $this -> category ;
    }

    public function setCategory ( ? Category $category ) : self
    {
        $this -> category = $category ;

        return $this ;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

     /**
     * @return Collection|Taxe[]
     */
    public function getTaxes(): Collection
    {
        return $this->taxes;
    }
    public function addTaxe(Taxe $taxe): self
    {
        if (!$this->taxes->contains($taxe)) {
            $this->taxes[] = $taxe;
        }
        return $this;
    }
    public function removeTaxe(Taxe $taxe): self
    {
        if ($this->taxes->contains($taxe)) {
            $this->taxes->removeElement($taxe);
        }
        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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
            $doccument->setProduct($this);
        }

        return $this;
    }

    public function removeDoccument(Doccument $doccument): self
    {
        if ($this->doccuments->contains($doccument)) {
            $this->doccuments->removeElement($doccument);
            // set the owning side to null (unless already changed)
            if ($doccument->getProduct() === $this) {
                $doccument->setProduct(null);
            }
        }

        return $this;
    }
}
