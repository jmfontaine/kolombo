<?php
namespace Kolombo\Plugin;

class Archives extends AbstractPlugin
{
    protected function getDictionaryFilename()
    {
        return 'archives.dict';
    }

    public function getName()
    {
        return 'Archives and compressed files';
    }
}