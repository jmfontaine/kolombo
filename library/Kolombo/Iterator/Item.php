<?php
namespace Kolombo\Iterator;

class Item extends \SplFileInfo
{
    public function getFileContent()
    {
        if (!$this->isFile()) {
            return false;
        }

        $path = $this->getPathname();
        if (!is_readable($path)) {
            throw new \RuntimeException("Can not read $path");
        }

        return file_get_contents($path, false);
    }

    public function getFileExtension()
    {
        if (!$this->isFile()) {
            return false;
        }

        $lastDotPosition = strrpos($this->getFilename(), '.');
        if (false === $lastDotPosition) {
            return;
        }

        return substr($this->getFilename(), $lastDotPosition);
    }
}
