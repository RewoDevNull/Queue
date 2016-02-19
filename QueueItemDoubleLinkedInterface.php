<?php

namespace Queue;

interface QueueItemDoubleLinkedInterface extends QueueItemSingleLinkedInterface
{
    public function getPrevious();

    public function setPrevious(QueueItemInterface $queueItem);

    public function setPreviousToNull();
}