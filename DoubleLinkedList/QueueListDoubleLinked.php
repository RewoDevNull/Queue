<?php

namespace Queue\DoubleLinkedList;

use Queue\QueueItemDoubleLinkedInterface;
use Queue\QueueItemInterface;
use Queue\QueueListInterface;

class QueueListDoubleLinked implements QueueListInterface
{
    /** @type QueueItemDoubleLinkedInterface $current */
    protected $current;
    /** @type QueueItemDoubleLinkedInterface $last */
    protected $first;
    /** @type QueueItemDoubleLinkedInterface $first */
    protected $last;
    /** @type int */
    protected $position = 0;

    public function __construct()
    {
        $this->position = 0;
        $this->current  = $this->first;
    }

    public function current()
    {
        $cur = clone $this->current;
        $cur->setNextToNull();
        $cur->setPreviousToNull();

        return $cur;
    }

    public function dequeue()
    {
        //if the first item is the last item in the queue throw an exception
        if ($this->first === null) {
            throw new \RuntimeException('the queue list is empty!');
        }
        /** @type QueueItemDoubleLinkedInterface $dequeuedItem */
        $dequeuedItem = $this->first;
        $this->first  = $dequeuedItem->getNext();
        $this->first->setPreviousToNull();

        $dequeuedItem->setNextToNull();
        $dequeuedItem->setPreviousToNull();

        $this->current = $this->first;

        return $dequeuedItem;
    }

    public function enqueue(QueueItemInterface $queueItem)
    {
        /** @type QueueItemDoubleLinkedInterface $enqueuedItem */
        $enqueuedItem = clone $queueItem;
        //if the queue list is empty and a item will be added set firstItem equals lastItem
        if ($this->first === null) {
            $this->first   = $enqueuedItem;
            $this->last    = $enqueuedItem;
            $this->current = $this->first;
        }
        else {
            $enqueuedItem->setPrevious($this->last);
            $this->last->setNext($enqueuedItem);
            $this->last = $this->last->getNext();
        }
    }

    /**
     * @inheritDoc
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @inheritDoc
     */
    public function getLast()
    {
        return $this->last;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
        $this->current = $this->current->getNext();
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->current);
    }

}