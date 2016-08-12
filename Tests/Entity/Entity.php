<?php

namespace Wandi\ToolsBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Entity
{
    /**
     * @var string
     */
    private $none;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $notBlank;

    /**
     * @var string
     * @Assert\Length(min=15)
     */
    private $length;

    /**
     * Entity constructor
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getNone()
    {
        return $this->none;
    }

    /**
     * @param string $none
     */
    public function setNone($none)
    {
        $this->none = $none;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotBlank()
    {
        return $this->notBlank;
    }

    /**
     * @param string $notBlank
     */
    public function setNotBlank($notBlank)
    {
        $this->notBlank = $notBlank;

        return $this;
    }

    /**
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param string $length
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }
}
