<?php

namespace Queue\implementation\test;

use Queue\implementation\QueueItem;
use Queue\implementation\QueueSingleLinkedList;
use Queue\implementation\QueueSingleLinkedListIterable;
use RuntimeException;

include_once('interfaces/QueueItemInterface.php');
include_once('interfaces/QueueSingleLinkedListInterface.php');
include_once('interfaces/QueueSingleLinkedListIterableInterface.php');
include_once('implementation/QueueItem.php');
include_once('implementation/QueueSingleLinkedList.php');
include_once('implementation/QueueSingleLinkedListIterable.php');

class QueueSingleLinkedListIterableTest extends \PHPUnit_Framework_TestCase
{
    /** @type QueueSingleLinkedListIterable */
    protected $queueListIterable = null;

    protected function setUp()
    {
        $this->queueListIterable = new QueueSingleLinkedListIterable();
    }

    public function testAddThreeItemsToQueueList()
    {
        $queueItem_1 = new QueueItem('Item1');
        $queueItem_2 = new QueueItem('Item2');
        $queueItem_3 = new QueueItem('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        /** @type QueueItem $firstItem */
        $firstItem = $this->queueListIterable->getFirst();

        /** @type QueueItem $lastItem */
        $lastItem = $this->queueListIterable->getLast();

        $this->assertEquals('Item1', $firstItem->getData());
        $this->assertEquals('Item3', $lastItem->getData());
    }

    public function testQueueListIteration()
    {
        $queueItem_1 = new QueueItem('Item1');
        $queueItem_2 = new QueueItem('Item2');
        $queueItem_3 = new QueueItem('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        $newQueue = new QueueSingleLinkedList();
        foreach ($this->queueListIterable as $queueItem) {
            $newQueue->enqueue($queueItem);
        }

        $this->assertEquals($newQueue->getFirst(), $this->queueListIterable->getFirst());
    }

    public function testRemoveFirstItemFromQueueList()
    {
        $queueItem_1 = new QueueItem('Item1');
        $queueItem_2 = new QueueItem('Item2');
        $queueItem_3 = new QueueItem('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        $removedItem = $this->queueListIterable->dequeue();
        $this->assertEquals('Item1', $removedItem->getData());

        /** @type QueueItem $firstItem */
        $firstItem = $this->queueListIterable->getFirst();
        $this->assertEquals('Item2', $firstItem->getData());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testRemoveItemFromEmptyQueueList()
    {
        $this->queueListIterable->dequeue();
    }


}
