<?php

namespace App\Entity;

use App\Repository\ResponsesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsesRepository::class)]
class Responses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $response = null;

    #[ORM\ManyToOne(inversedBy: 'responses')]
    private ?User $person = null;

    #[ORM\ManyToOne(inversedBy: 'responses')]
    private ?BabyQuestions $babyQuestion = null;

    #[ORM\ManyToOne(inversedBy: 'responses')]
    private ?ParentsQuestions $parentQuestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(string $response): static
    {
        $this->response = $response;

        return $this;
    }

    public function getPerson(): ?User
    {
        return $this->person;
    }

    public function setPerson(?User $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function getBabyQuestion(): ?BabyQuestions
    {
        return $this->babyQuestion;
    }

    public function setBabyQuestion(?BabyQuestions $babyQuestion): static
    {
        $this->babyQuestion = $babyQuestion;

        return $this;
    }

    public function getParentQuestion(): ?ParentsQuestions
    {
        return $this->parentQuestion;
    }

    public function setParentQuestion(?ParentsQuestions $parentQuestion): static
    {
        $this->parentQuestion = $parentQuestion;

        return $this;
    }
}
