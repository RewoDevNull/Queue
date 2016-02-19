<?php

namespace Queue\implementation;

use Queue\interfaces\QueueItemInterface;

class QueueItem implements QueueItemInterface
{
    /** @type QueueItemInterface $next */
    protected $next = null;
    protected $data = null;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext(QueueItemInterface $queueItem)
    {
        $this->next = $queueItem;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setNextToNull()
    {
        $this->next = null;
    }
}