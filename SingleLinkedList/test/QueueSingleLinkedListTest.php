<?php

namespace Queue\SingleLinkedList\test;

use Queue\SingleLinkedList\QueueItemSingleLinked;
use Queue\SingleLinkedList\QueueListSingleLinked;

include_once('../../QueueListInterface.php');
include_once('../../QueueItemInterface.php');
include_once('../../QueueItemSingleLinkedInterface.php');
include_once('../QueueItemSingleLinked.php');
include_once('../QueueListSingleLinked.php');

class QueueSingleLinkedListTest extends \PHPUnit_Framework_TestCase
{
    /** @type QueueListSingleLinked */
    protected $queueListIterable = null;

    protected function setUp()
    {
        $this->queueListIterable = new QueueListSingleLinked();
    }

    public function testAddThreeItemsToQueueList()
    {
        $queueItem_1 = new QueueItemSingleLinked('Item1');
        $queueItem_2 = new QueueItemSingleLinked('Item2');
        $queueItem_3 = new QueueItemSingleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        /** @type QueueItemSingleLinked $firstItem */
        $firstItem = $this->queueListIterable->getFirst();

        /** @type QueueItemSingleLinked $lastItem */
        $lastItem = $this->queueListIterable->getLast();

        $this->assertEquals('Item1', $firstItem->getData());
        $this->assertEquals('Item3', $lastItem->getData());
    }

    public function testQueueListIteration()
    {
        $queueItem_1 = new QueueItemSingleLinked('Item1');
        $queueItem_2 = new QueueItemSingleLinked('Item2');
        $queueItem_3 = new QueueItemSingleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        $newQueue = new QueueListSingleLinked();
        foreach ($this->queueListIterable as $queueItem) {
            $newQueue->enqueue($queueItem);
        }

        $this->assertEquals($newQueue->getFirst(), $this->queueListIterable->getFirst());
    }

    public function testRemoveFirstItemFromQueueList()
    {
        $queueItem_1 = new QueueItemSingleLinked('Item1');
        $queueItem_2 = new QueueItemSingleLinked('Item2');
        $queueItem_3 = new QueueItemSingleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        /** @type QueueItemSingleLinked $removedItem */
        $removedItem = $this->queueListIterable->dequeue();
        $this->assertEquals('Item1', $removedItem->getData());

        /** @type QueueItemSingleLinked $firstItem */
        $firstItem = $this->queueListIterable->getFirst();
        $this->assertEquals('Item2', $firstItem->getData());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRemoveItemFromEmptyQueueList()
    {
        $this->queueListIterable->dequeue();
    }


}
