<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * ObjectField
 */
class ObjectField
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
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $type;


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
     * @return ObjectField
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
     * Set code
     *
     * @param string $code
     *
     * @return ObjectField
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ObjectField
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var \NCMF\DefaultBundle\Entity\Object
     */
    private $object;


    /**
     * Set object
     *
     * @param \NCMF\DefaultBundle\Entity\Object $object
     *
     * @return ObjectField
     */
    public function setObject(\NCMF\DefaultBundle\Entity\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \NCMF\DefaultBundle\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $valuesText;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->valuesText = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add valuesText
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueText $valuesText
     *
     * @return ObjectField
     */
    public function addValuesText(\NCMF\DefaultBundle\Entity\FieldValueText $valuesText)
    {
        $this->valuesText[] = $valuesText;

        return $this;
    }

    /**
     * Remove valuesText
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueText $valuesText
     */
    public function removeValuesText(\NCMF\DefaultBundle\Entity\FieldValueText $valuesText)
    {
        $this->valuesText->removeElement($valuesText);
    }

    /**
     * Get valuesText
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValuesText()
    {
        return $this->valuesText;
    }
}
