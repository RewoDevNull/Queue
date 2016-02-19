<?php
namespace Queue\interfaces;

include_once('interfaces/QueueSingleLinkedListInterface.php');

interface QueueSingleLinkedListIterableInterface extends QueueSingleLinkedListInterface, \Iterator
{

}