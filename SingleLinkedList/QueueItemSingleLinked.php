<?php

namespace Queue\SingleLinkedList;

use Queue\QueueItemInterface;
use Queue\QueueItemSingleLinkedInterface;

class QueueItemSingleLinked implements QueueItemSingleLinkedInterface
{
    protected $data = null;
    protected $next = null;

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

    public function setNext(QueueItemInterface $queueItem)
    {
        $this->next = $queueItem;
    }

    public function setNextToNull()
    {
        $this->next = null;
    }
}