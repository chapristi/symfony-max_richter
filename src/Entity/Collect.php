<?php

namespace App\Entity;

use App\Enum\StatutJeuEnum;
use App\Repository\CollectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CollectRepository::class)]
class Collect
{
    #[Groups(['collect:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['collect:read'])]
    #[ORM\ManyToOne(inversedBy: 'collects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;
    #[Groups(['collect:read'])]
    #[ORM\ManyToOne(inversedBy: 'collects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JeuVideo $jeuvideo = null;
    #[Groups(['collect:read'])]
    #[ORM\Column(length: 30, enumType: StatutJeuEnum::class)]
    private  StatutJeuEnum $statut = StatutJeuEnum::POSSEDE;
    #[Groups(['collect:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $dateModifStatut = null;
    #[Groups(['collect:read'])]
    #[ORM\Column(nullable: true)]
    private ?float $prixAchat = null;
    #[Groups(['collect:read'])]
    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAchat = null;
    #[Groups(['collect:read'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;
    #[Groups(['collect:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;
    #[Groups(['collect:read'])]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(){
        $this->statut = StatutJeuEnum::POSSEDE;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getJeuvideo(): ?JeuVideo
    {
        return $this->jeuvideo;
    }

    public function setJeuvideo(?JeuVideo $jeuvideo): static
    {
        $this->jeuvideo = $jeuvideo;

        return $this;
    }

    public function getStatut(): ?StatutJeuEnum
    {
        return $this->statut;
    }

    public function setStatut(StatutJeuEnum $statut): static
    {
        $this->statut = $statut;
        $this->setUpdatedAt(new \DateTimeImmutable());

        return $this;
    }

    public function getDateModifStatut(): ?\DateTimeImmutable
    {
        return $this->dateModifStatut;
    }

    public function setDateModifStatut(\DateTimeImmutable $dateModifStatut): static
    {
        $this->dateModifStatut = $dateModifStatut;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(?float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->dateAchat;
    }

    public function setDateAchat(?\DateTime $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

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

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
