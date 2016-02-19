<?php

namespace Queue\DoubleLinkedList;

use Queue\QueueItemDoubleLinkedInterface;
use Queue\QueueItemInterface;

class QueueItemDoubleLinked implements QueueItemDoubleLinkedInterface
{
    protected $data     = null;
    protected $next     = null;
    protected $previous = null;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setNext(QueueItemInterface $queueItem)
    {
        $this->next = $queueItem;
    }

    public function setNextToNull()
    {
        $this->next = null;
    }

    public function setPrevious(QueueItemInterface $queueItem)
    {
        $this->previous = $queueItem;
    }

    public function setPreviousToNull()
    {
        $this->previous = null;
    }

}