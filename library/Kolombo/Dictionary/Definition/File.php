<?php
namespace Kolombo\Dictionary\Definition;

class File extends AbstractDefinition
{
    private $extension;

    private $mimeTypes = array();

    public function __construct($extension, $isRegex, $description, array $mimeTypes)
    {
        $this->setDescription($description)
             ->setExtension($extension)
             ->setMimeTypes($mimeTypes)
             ->setIsRegex($isRegex);
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getMimeTypes()
    {
        return $this->mimeTypes;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    public function setMimeTypes(array $mimeTypes)
    {
        $this->mimeTypes = $mimeTypes;

        return $this;
    }
}