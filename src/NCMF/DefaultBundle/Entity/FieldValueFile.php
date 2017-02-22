<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * FieldValueFile
 */
class FieldValueFile
{
    /**
     * @var int
     */
    private $id;


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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \NCMF\DefaultBundle\Entity\File
     */
    private $file;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return FieldValueFile
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
     * Set description
     *
     * @param string $description
     *
     * @return FieldValueFile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set file
     *
     * @param \NCMF\DefaultBundle\Entity\File $file
     *
     * @return FieldValueFile
     */
    public function setFile(\NCMF\DefaultBundle\Entity\File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \NCMF\DefaultBundle\Entity\File
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @var \NCMF\DefaultBundle\Entity\ObjectField
     */
    private $field;

    /**
     * @var \NCMF\DefaultBundle\Entity\Instance
     */
    private $instance;


    /**
     * Set field
     *
     * @param \NCMF\DefaultBundle\Entity\ObjectField $field
     *
     * @return FieldValueFile
     */
    public function setField(\NCMF\DefaultBundle\Entity\ObjectField $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \NCMF\DefaultBundle\Entity\ObjectField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set instance
     *
     * @param \NCMF\DefaultBundle\Entity\Instance $instance
     *
     * @return FieldValueFile
     */
    public function setInstance(\NCMF\DefaultBundle\Entity\Instance $instance = null)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return \NCMF\DefaultBundle\Entity\Instance
     */
    public function getInstance()
    {
        return $this->instance;
    }
}
