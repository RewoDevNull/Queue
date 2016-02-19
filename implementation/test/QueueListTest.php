<?php

namespace Queue\implementation\test;

use Queue\implementation\QueueItem;
use Queue\implementation\QueueList;
use RuntimeException;

include_once('Queue/interfaces/QueueItemInterface.php');
include_once('Queue/interfaces/QueueListInterface.php');
include_once('Queue/implementation/QueueList.php');
include_once('Queue/implementation/QueueItem.php');

class QueueListTest extends \PHPUnit_Framework_TestCase
{
    /** @type QueueList */
    protected $queueList;

    protected function setUp()
    {
        $this->queueList = new QueueList();
    }

    public function testAddThreeItemsToQueueList()
    {
        $queueItem_1 = new QueueItem('Item1');
        $queueItem_2 = new QueueItem('Item2');
        $queueItem_3 = new QueueItem('Item3');
        $this->queueList->enqueue($queueItem_1);
        $this->queueList->enqueue($queueItem_2);
        $this->queueList->enqueue($queueItem_3);

        /** @type QueueItem $firstItem */
        $firstItem = $this->queueList->getFirst();

        /** @type QueueItem $lastItem */
        $lastItem = $this->queueList->getLast();

        $this->assertEquals('Item1', $firstItem->getData());
        $this->assertEquals('Item3', $lastItem->getData());
    }

    public function testRemoveFirstItemFromQueueList()
    {
        $queueItem_1 = new QueueItem('Item1');
        $queueItem_2 = new QueueItem('Item2');
        $queueItem_3 = new QueueItem('Item3');
        $this->queueList->enqueue($queueItem_1);
        $this->queueList->enqueue($queueItem_2);
        $this->queueList->enqueue($queueItem_3);

        $removedItem = $this->queueList->dequeue();
        $this->assertEquals('Item1', $removedItem->getData());

        /** @type QueueItem $firstItem */
        $firstItem = $this->queueList->getFirst();
        $this->assertEquals('Item2', $firstItem->getData());
    }

    public function testRemoveItemFromEmptyQueueList()
    {
        $this->expectException(\RuntimeException::class);
        $this->queueList->dequeue();
    }

}