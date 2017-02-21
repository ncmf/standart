<?php

namespace NCMF\DefaultBundle\Entity;

/**
 * Instance
 */
class Instance
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
     * @return Instance
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
     * @return Instance
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
     * @var \NCMF\DefaultBundle\Entity\Object
     */
    private $object;


    /**
     * Set object
     *
     * @param \NCMF\DefaultBundle\Entity\Object $object
     *
     * @return Instance
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
}
