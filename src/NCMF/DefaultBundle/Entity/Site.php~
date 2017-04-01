<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * Site
 */
class Site
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Site
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @var boolean
     */
    private $closed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $aliases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aliases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Site
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Add alias
     *
     * @param \NCMF\DefaultBundle\Entity\SiteAlias $alias
     *
     * @return Site
     */
    public function addAlias(\NCMF\DefaultBundle\Entity\SiteAlias $alias)
    {
        $this->aliases[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \NCMF\DefaultBundle\Entity\SiteAlias $alias
     */
    public function removeAlias(\NCMF\DefaultBundle\Entity\SiteAlias $alias)
    {
        $this->aliases->removeElement($alias);
    }

    /**
     * Get aliases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAliases()
    {
        return $this->aliases;
    }
}
