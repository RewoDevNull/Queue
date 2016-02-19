<?php

namespace Queue\implementation;

use Queue\interfaces\QueueItemInterface;

class QueueItem implements QueueItemInterface
{
    protected $data = null;
    /** @type QueueItemInterface $next */
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