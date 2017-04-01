<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * ObjectField
 */
class ObjectField
{
  
    
    /**
     * @var integer
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $valueText;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $valueFile;

    /**
     * @var \NCMF\DefaultBundle\Entity\Object
     */
    private $object;

    /**
     * @var \NCMF\DefaultBundle\Entity\FieldType
     */
    private $fieldType;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->valueText = new \Doctrine\Common\Collections\ArrayCollection();
        $this->valueFile = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
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
     * Add valueText
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueText $valueText
     *
     * @return ObjectField
     */
    public function addValueText(\NCMF\DefaultBundle\Entity\FieldValueText $valueText)
    {
        $this->valueText[] = $valueText;

        return $this;
    }

    /**
     * Remove valueText
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueText $valueText
     */
    public function removeValueText(\NCMF\DefaultBundle\Entity\FieldValueText $valueText)
    {
        $this->valueText->removeElement($valueText);
    }

    /**
     * Get valueText
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValueText()
    {
        return $this->valueText;
    }

    /**
     * Add valueFile
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueFile $valueFile
     *
     * @return ObjectField
     */
    public function addValueFile(\NCMF\DefaultBundle\Entity\FieldValueFile $valueFile)
    {
        $this->valueFile[] = $valueFile;

        return $this;
    }

    /**
     * Remove valueFile
     *
     * @param \NCMF\DefaultBundle\Entity\FieldValueFile $valueFile
     */
    public function removeValueFile(\NCMF\DefaultBundle\Entity\FieldValueFile $valueFile)
    {
        $this->valueFile->removeElement($valueFile);
    }

    /**
     * Get valueFile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValueFile()
    {
        return $this->valueFile;
    }

    /**
     * Set object
     *
     * @param \NCMF\DefaultBundle\Entity\Object $object
     *
     * @return ObjectField
     */
    public function setObject(\NCMF\DefaultBundle\Entity\Object $object)
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
     * Set fieldType
     *
     * @param \NCMF\DefaultBundle\Entity\FieldType $fieldType
     *
     * @return ObjectField
     */
    public function setFieldType(\NCMF\DefaultBundle\Entity\FieldType $fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get fieldType
     *
     * @return \NCMF\DefaultBundle\Entity\FieldType
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }
}
