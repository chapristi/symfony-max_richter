<?php

namespace App\Entity;

use App\Repository\JeuVideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JeuVideoRepository::class)]
class JeuVideo
{
    #[Groups(['jv:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['jv:read','minimum'])]
    #[ORM\Column(length: 255)]
    private ?string $titre = null;
    #[Groups(['jv:read'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateSortie = null;
    #[Groups(['jv:read'])]
    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $prix = null;
    #[Groups(['jv:read'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;
    #[Groups(['jv:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;
    #[Groups(['jv:read'])]
    #[ORM\ManyToOne(inversedBy: 'jeuVideos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Editeur $editeur = null;
    #[Groups(['jv:read'])]
    #[ORM\ManyToOne(inversedBy: 'jeuVideos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;
    #[Groups(['jv:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;
    #[Groups(['jv:read'])]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    #[Groups(['jv:read'])]
    #[ORM\ManyToOne(inversedBy: 'jeuVideos')]
    private ?Developpeur $developpeur = null;

    /**
     * @var Collection<int, Collect>
     */
    #[ORM\OneToMany(targetEntity: Collect::class, mappedBy: 'jeuvideo')]
    private Collection $collects;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->collects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }


    public function getDateSortie(): ?\DateTime
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTime $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): static
    {
        $this->prix = $prix;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeveloppeur(): ?Developpeur
    {
        return $this->developpeur;
    }

    public function setDeveloppeur(?Developpeur $idDeveloppeur): static
    {
        $this->developpeur = $idDeveloppeur;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return Collection<int, Collect>
     */
    public function getCollects(): Collection
    {
        return $this->collects;
    }

    public function addCollect(Collect $collect): static
    {
        if (!$this->collects->contains($collect)) {
            $this->collects->add($collect);
            $collect->setJeuvideo($this);
        }

        return $this;
    }

    public function removeCollect(Collect $collect): static
    {
        if ($this->collects->removeElement($collect)) {
            // set the owning side to null (unless already changed)
            if ($collect->getJeuvideo() === $this) {
                $collect->setJeuvideo(null);
            }
        }

        return $this;
    }
}
