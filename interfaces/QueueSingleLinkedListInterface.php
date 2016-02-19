<?php
namespace Queue\interfaces;

interface QueueSingleLinkedListInterface
{
    /**
     * Remove a item from the queue
     *
     * @return QueueItemInterface
     */
    public function dequeue();

    /**
     * Add a item to the queue
     *
     * @param QueueItemInterface $queueItem
     */
    public function enqueue(QueueItemInterface $queueItem);

    /**
     * Get the first item of the queue
     *
     * @return QueueItemInterface|null
     */
    public function getFirst();


    /**
     * Get the last item of the queue
     *
     * @return QueueItemInterface|null
     */
    public function getLast();
}