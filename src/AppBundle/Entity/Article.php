<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NewsRepository")
 * @ORM\Table(name="news")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="articles")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Rubric", inversedBy="articles")
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id")
     */
    private $rubric;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreated()
    {
        return $this->created_at;
    }

    public function setCreated($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdated()
    {
        return $this->updated_at;
    }

    public function setUpdated()
    {
        $this->updated_at = new \DateTime('now');
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getRubric()
    {
        return $this->rubric;
    }

    public function siRedacted(): bool
    {
        return null !== $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
