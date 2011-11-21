<?php
namespace Kolombo\Plugin;

use Kolombo\Dictionary\Definition\DefinitionInterface;

use Kolombo\Dictionary\Dictionary;
use Kolombo\Iterator\Item as IteratorItem;
use Kolombo\Report\Item as ReportItem;
use Kolombo\Report\Report;

abstract class AbstractPlugin implements PluginInterface
{
    private $dictionary;

    private $directory;

    private $report;

    abstract protected function getDictionaryFilename();

    protected function loadDictionnary($level)
    {
        $path = $this->directory . '/' . $this->getDictionaryFilename();
        $this->dictionary = new Dictionary($path, $level);
    }

    public function __construct($directory, Report $report, $level)
    {
        $this->directory = $directory;
        $this->report    = $report;

        $this->loadDictionnary($level);
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function process(IteratorItem $iteratorItem)
    {
        $definition = null;

        if ($iteratorItem->isFile()) {
            $extension  = strtolower($iteratorItem->getFileExtension());
            $definition = $this->getDictionary()->getDefinitionByExtension($extension);
        } elseif ($iteratorItem->isDir()) {
            $path       = strtolower($iteratorItem->getPath());
            $name       = basename($path);
            $definition = $this->getDictionary()->getDefinitionByDirectoryName($name);
        }

        if ($definition instanceof DefinitionInterface) {
            $this->getReport()->addItem(new ReportItem($iteratorItem, $this, $definition));
        }
    }
}