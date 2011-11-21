<?php
namespace Kolombo\Report;

class Report implements \Iterator
{
    private $cursor;

    private $items = array();

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    /*
     * Iterator interface methods
     */
    public function current()
    {
        return $this->items[$this->cursor];
    }

    public function key()
    {
        return $this->cursor;
    }

    public function next()
    {
        $this->cursor++;
    }

    public function rewind()
    {
        $this->cursor = 0;
    }

    public function valid()
    {
        return array_key_exists($this->cursor, $this->items);
    }
}