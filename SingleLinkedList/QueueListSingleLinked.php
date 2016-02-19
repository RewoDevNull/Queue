<?php

namespace Queue\SingleLinkedList;

use Queue\QueueItemInterface;
use Queue\QueueItemSingleLinkedInterface;
use Queue\QueueListInterface;

/**
 * Class QueueList
 *
 * A queue is a data structure which implements the FIFO (first in, first out) rule.
 * In a FIFO data structure, the first element added to the queue will be the first one to be removed.
 * The queue is implemented as a single linked list what means that the first item hold a reference to the item before
 * it.
 *
 * Example (adding / enqueue):
 *  - Item to add:
 *      [ 3 ]
 *
 *  - Items in queue:
 *      [ 2 ]  |  [ 1 ]
 *      (last)    (first)
 *
 *  - Items in queue after adding:
 *      [ 3 ]  |  [ 2 ]  |  [ 1 ]
 *      (last)              (first)
 *
 *  => by adding a new item to the queue list the item '2' will be moved one to the right and the new item '3' will be
 *  marked as last item. The item '1' has a 'next()'-reference to the left item '2' of it. The item '2' has a
 *  'next()'-reference to the left and last item '3'.
 *
 *  Example (removing / dequeue):
 *  - Item to remove:
 *      [ 1 ]
 *
 *  - Items in queue:
 *      [ 3 ]  |  [ 2 ]  |  [ 1 ]
 *      (last)              (first)
 *
 *  - Items in queue after adding:
 *      [ 3 ]  |  [ 2 ]
 *      (last)    (first)
 *
 *  => by dequeueing the first item of the queue list the item '2' will be moved one to the right and will be marked as
 *  first item. The removed item '1' had a 'next()'-reference to the left item '2' of it. The item '2' has a
 *  'next()'-reference to the left and last item '3'.
 *
 * @see     http://introcs.cs.princeton.edu/java/43stack/
 * @see     http://introcs.cs.princeton.edu/java/43stack/Queue.java.html
 *
 * @package PHPSimpleQueue
 */
class QueueListSingleLinked implements QueueListInterface
{
    /** @type QueueItemSingleLinkedInterface $current */
    protected $current;
    /** @type QueueItemSingleLinkedInterface $last */
    protected $first;
    /** @type QueueItemSingleLinkedInterface $first */
    protected $last;
    /** @type int */
    protected $position = 0;

    public function __construct()
    {
        $this->position = 0;
        $this->current  = $this->first;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        $cur = clone $this->current;
        $cur->setNextToNull();

        return $cur;
    }

    /**
     * @inheritDoc
     */
    public function dequeue()
    {
        //if the first item is the last item in the queue throw an exception
        if ($this->first === null) {
            throw new \RuntimeException('the queue list is empty!');
        }
        /** @type QueueItemSingleLinkedInterface $dequeuedItem */
        $dequeuedItem = $this->first;
        $this->first  = $dequeuedItem->getNext();
        $dequeuedItem->setNextToNull();

        return $dequeuedItem;
    }

    /**
     * @inheritDoc
     */
    public function enqueue(QueueItemInterface $enqueuedItem)
    {
        //if the queue list is empty and a item will be added set firstItem equals lastItem
        if ($this->first === null) {
            $this->first = $enqueuedItem;
            $this->last  = $enqueuedItem;
        }
        else {
            $this->last->setNext($enqueuedItem);
            $this->last = $this->last->getNext();
        }
        $this->current = $this->first;
    }

    /**
     * @inheritDoc
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @inheritDoc
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        ++$this->position;
        $this->current = $this->current->getNext();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->current);
    }
}