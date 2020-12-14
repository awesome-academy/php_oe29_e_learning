<?php
namespace App\Repositories\Message;

interface MessageRepositoryInterface
{
    public function getMessageBetweenUser($fromId, $senderId);
}
