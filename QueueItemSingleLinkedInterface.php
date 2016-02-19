<?php

namespace Queue;

include_once('QueueItemInterface.php');

interface QueueItemSingleLinkedInterface extends QueueItemInterface
{
    public function getNext();

    public function setNext(QueueItemInterface $queueItem);

    public function setNextToNull();
}