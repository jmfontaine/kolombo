<?php
namespace Kolombo\Dictionary\Definition;

class AbstractDefinition implements DefinitionInterface
{
    private $description;

    private $isRegex = false;

    public function getDescription()
    {
        return $this->description;
    }

    public function isRegex()
    {
        return $this->isRegex;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setIsRegex($isRegex)
    {
        $this->isRegex = $isRegex;

        return $this;
    }
}