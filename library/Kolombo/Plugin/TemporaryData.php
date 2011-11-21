<?php
namespace Kolombo\Plugin;

class TemporaryData extends AbstractPlugin
{
    protected function getDictionaryFilename()
    {
        return 'temporary-data.dict';
    }

    public function getName()
    {
        return 'Temporary files and directories';
    }
}