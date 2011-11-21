<?php
namespace Kolombo\Plugin;

use Kolombo\Iterator\Item as IteratorItem;

interface PluginInterface
{
    public function getDictionary();

    public function getName();

    public function getReport();

    public function process(IteratorItem $iteratorItem);
}