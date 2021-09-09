<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resume;

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="Recette")
     */
    private $operations;

    /**
     * @ORM\OneToMany(targetEntity=RecetteIngredient::class, mappedBy="recette")
     */
    private $recette;



    public function __construct()
    {
        $this->operations = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->RecetteIngredient = new ArrayCollection();
        $this->recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setRecette($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getRecette() === $this) {
                $operation->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecetteIngredient[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(RecetteIngredient $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->setRecette($this);
        }

        return $this;
    }

    public function removeRecette(RecetteIngredient $recette): self
    {
        if ($this->recette->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getRecette() === $this) {
                $recette->setRecette(null);
            }
        }

        return $this;
    }

   

    
}
