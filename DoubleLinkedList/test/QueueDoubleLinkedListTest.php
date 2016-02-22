<?php

namespace Queue\SingleLinkedList\test;

use Queue\Autoloader\Autoloader;
use Queue\DoubleLinkedList\QueueItemDoubleLinked;
use Queue\DoubleLinkedList\QueueListDoubleLinked;

class QueueDoubleLinkedListTest extends \PHPUnit_Framework_TestCase
{
    /** @type QueueListDoubleLinked */
    protected $queueListIterable = null;

    protected function setUp()
    {
        require_once('../../Autoloader/Autoloader.php');
        spl_autoload_register(Autoloader::getAutoloaderCallable());
        $this->queueListIterable = new QueueListDoubleLinked();
    }

    public function testAddThreeItemsToQueueList()
    {
        $queueItem_1 = new QueueItemDoubleLinked('Item1');
        $queueItem_2 = new QueueItemDoubleLinked('Item2');
        $queueItem_3 = new QueueItemDoubleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        /** @type QueueItemDoubleLinked $firstItem */
        $firstItem = $this->queueListIterable->getFirst();

        /** @type QueueItemDoubleLinked $lastItem */
        $lastItem = $this->queueListIterable->getLast();
        $this->assertEquals('Item1', $firstItem->getData());
        $this->assertEquals('Item3', $lastItem->getData());
    }

    public function testQueueListIteration()
    {
        $queueItem_1 = new QueueItemDoubleLinked('Item1');
        $queueItem_2 = new QueueItemDoubleLinked('Item2');
        $queueItem_3 = new QueueItemDoubleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        $newQueue = new QueueListDoubleLinked();
        foreach ($this->queueListIterable as $queueItem) {
            $newQueue->enqueue(clone $queueItem);
            print_r(clone $queueItem);
        }

        $this->assertEquals($newQueue->getFirst(), $this->queueListIterable->getFirst());
    }

    public function testRemoveFirstItemFromQueueList()
    {
        $queueItem_1 = new QueueItemDoubleLinked('Item1');
        $queueItem_2 = new QueueItemDoubleLinked('Item2');
        $queueItem_3 = new QueueItemDoubleLinked('Item3');
        $this->queueListIterable->enqueue($queueItem_1);
        $this->queueListIterable->enqueue($queueItem_2);
        $this->queueListIterable->enqueue($queueItem_3);

        /** @type QueueItemDoubleLinked $removedItem */
        $removedItem = $this->queueListIterable->dequeue();
        $this->assertEquals('Item1', $removedItem->getData());

        /** @type QueueItemDoubleLinked $firstItem */
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
