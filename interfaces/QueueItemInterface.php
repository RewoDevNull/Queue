<?php

namespace Queue\interfaces;


interface QueueItemInterface
{
    public function getNext();

    public function setNext(QueueItemInterface $queueItem);

    public function setNextToNull();
}