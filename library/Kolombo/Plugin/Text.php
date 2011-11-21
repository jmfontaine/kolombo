<?php
namespace Kolombo\Plugin;

class Text extends AbstractPlugin
{
    protected function getDictionaryFilename()
    {
        return 'Text.dict';
    }

    public function getName()
    {
        return 'Text files';
    }
}