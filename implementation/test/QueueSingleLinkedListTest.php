<?php

namespace Queue\implementation\test;

use Queue\implementation\QueueItem;
use Queue\implementation\QueueSingleLinkedList;
use RuntimeException;

include_once('interfaces/QueueItemInterface.php');
include_once('interfaces/QueueSingleLinkedListInterface.php');
include_once('implementation/QueueItem.php');
include_once('implementation/QueueSingleLinkedList.php');

class QueueSingleLinkedListTest extends \PHPUnit_Framework_TestCase
{
    /** @type QueueSingleLinkedList */
    protected $queueList;

    protected function setUp()
    {
        $this->queueList = new QueueSingleLinkedList();
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

    /**
     * @expectedException RuntimeException
     */
    public function testRemoveItemFromEmptyQueueList()
    {
        $this->queueList->dequeue();
    }

}