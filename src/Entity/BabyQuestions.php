<?php

namespace App\Entity;

use App\Repository\BabyQuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BabyQuestionsRepository::class)]
class BabyQuestions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\OneToMany(targetEntity: Responses::class, mappedBy: 'babyQuestion')]
    private Collection $responses;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, Responses>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Responses $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setBabyQuestion($this);
        }

        return $this;
    }

    public function removeResponse(Responses $response): static
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getBabyQuestion() === $this) {
                $response->setBabyQuestion(null);
            }
        }

        return $this;
    }
}
