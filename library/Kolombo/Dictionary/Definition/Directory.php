<?php
namespace Kolombo\Dictionary\Definition;

class Directory extends AbstractDefinition
{
    private $name;

    public function __construct($name, $isRegex, $description)
    {
        $this->setDescription($description)
             ->setName($name)
             ->setIsRegex($isRegex);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}