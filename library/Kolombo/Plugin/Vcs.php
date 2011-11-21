<?php
namespace Kolombo\Plugin;

class Vcs extends AbstractPlugin
{
    protected function getDictionaryFilename()
    {
        return 'vcs.dict';
    }

    public function getName()
    {
        return 'VCS files and directories';
    }
}