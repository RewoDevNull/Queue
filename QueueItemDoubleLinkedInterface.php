<?php

namespace Queue;

include_once('QueueItemInterface.php');

interface QueueItemDoubleLinkedInterface extends QueueItemSingleLinkedInterface
{
    public function getPrevious();

    public function setPrevious(QueueItemInterface $queueItem);

    public function setPreviousToNull();
}