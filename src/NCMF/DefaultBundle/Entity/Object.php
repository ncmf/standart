<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * Object
 */
class Object
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
     * @return Object
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $instances;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $fields;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instances = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add instance
     *
     * @param \NCMF\DefaultBundle\Entity\Instance $instance
     *
     * @return Object
     */
    public function addInstance(\NCMF\DefaultBundle\Entity\Instance $instance)
    {
        $this->instances[] = $instance;

        return $this;
    }

    /**
     * Remove instance
     *
     * @param \NCMF\DefaultBundle\Entity\Instance $instance
     */
    public function removeInstance(\NCMF\DefaultBundle\Entity\Instance $instance)
    {
        $this->instances->removeElement($instance);
    }

    /**
     * Get instances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstances()
    {
        return $this->instances;
    }

    /**
     * Add field
     *
     * @param \NCMF\DefaultBundle\Entity\ObjectField $field
     *
     * @return Object
     */
    public function addField(\NCMF\DefaultBundle\Entity\ObjectField $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param \NCMF\DefaultBundle\Entity\ObjectField $field
     */
    public function removeField(\NCMF\DefaultBundle\Entity\ObjectField $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }
}
