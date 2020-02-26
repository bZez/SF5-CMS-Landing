<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Simulator", mappedBy="page", cascade={"persist", "remove"})
     */
    private $simulator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lead", mappedBy="isFrom", orphanRemoval=true)
     */
    private $leads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tag", mappedBy="page")
     */
    private $tags;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isIndexed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFollowed;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $favicon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customColor;

    /**
     * @ORM\Column(type="integer")
     */
    private $base;

    public function __construct()
    {
        $this->leads = new ArrayCollection();
        $this->newLeads = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }


    public function getSimulator(): ?Simulator
    {
        return $this->simulator;
    }

    public function setSimulator(?Simulator $simulator): self
    {
        $this->simulator = $simulator;

        // set (or unset) the owning side of the relation if necessary
        $newPage = null === $simulator ? null : $this;
        if ($simulator->getPage() !== $newPage) {
            $simulator->setPage($newPage);
        }

        return $this;
    }

    /**
     * @return Collection|Lead[]
     */
    public function getLeads(): Collection
    {
        return $this->leads;
    }


    public function getNewLeads()
    {
        $news = [];
        foreach ($this->leads as $lead){
            /** @var Lead $lead */
            if($lead->getExported() === false){
                $news[] = $lead;
            }
        }
        return $news;
    }

    public function addLead(Lead $lead): self
    {
        if (!$this->leads->contains($lead)) {
            $this->leads[] = $lead;
            $lead->setPage($this);
        }

        return $this;
    }

    public function removeLead(Lead $lead): self
    {
        if ($this->leads->contains($lead)) {
            $this->leads->removeElement($lead);
            // set the owning side to null (unless already changed)
            if ($lead->getPage() === $this) {
                $lead->setPage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setPage($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getPage() === $this) {
                $tag->setPage(null);
            }
        }

        return $this;
    }

    public function getIsIndexed(): ?bool
    {
        return $this->isIndexed;
    }

    public function setIsIndexed(?bool $isIndexed): self
    {
        $this->isIndexed = $isIndexed;

        return $this;
    }

    public function getIsFollowed(): ?bool
    {
        return $this->isFollowed;
    }

    public function setIsFollowed(?bool $isFollowed): self
    {
        $this->isFollowed = $isFollowed;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    public function setFavicon(?string $favicon): self
    {
        $this->favicon = $favicon;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCustomColor(): ?string
    {
        return $this->customColor;
    }

    public function setCustomColor(?string $customColor): self
    {
        $this->customColor = $customColor;

        return $this;
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(int $base): self
    {
        $this->base = $base;

        return $this;
    }


}
