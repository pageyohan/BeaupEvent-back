<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $studentNb = null;

    #[ORM\Column]
    private ?int $place_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStudentNb(): ?int
    {
        return $this->studentNb;
    }

    public function setStudentNb(?int $studentNb): static
    {
        $this->studentNb = $studentNb;

        return $this;
    }

    #[Route('/classe/{id}', name: 'classe_show', methods: ['GET'])]
    public function show(Classe $classe): Response
    {
        return $this->render('classe/show.html.twig', ['classe' => $classe]);
    }

    public function getPlaceId(): ?int
    {
        return $this->place_id;
    }

    public function setPlaceId(int $place_id): static
    {
        $this->place_id = $place_id;

        return $this;
    }
}
