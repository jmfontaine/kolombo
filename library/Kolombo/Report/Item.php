<?php
namespace Kolombo\Report;

use Kolombo\Dictionary\Definition\DefinitionInterface;
use Kolombo\Iterator\Item as IteratorItem;
use Kolombo\Plugin\PluginInterface;

class Item
{
    private $definition;

    private $item;

    private $plugin;

    public function __construct(IteratorItem $item, PluginInterface $plugin, DefinitionInterface $definition)
    {
        $this->definition = $definition;
        $this->item       = $item;
        $this->plugin     = $plugin;
    }

    public function getDefinition()
    {
        return $this->definition;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getPlugin()
    {
        return $this->plugin;
    }
}