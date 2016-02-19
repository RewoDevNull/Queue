<?php

namespace Queue;

interface QueueItemSingleLinkedInterface extends QueueItemInterface
{
    public function getNext();

    public function setNext(QueueItemInterface $queueItem);

    public function setNextToNull();
}