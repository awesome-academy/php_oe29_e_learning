<?php
namespace App\Repositories\Message;

use App\Repositories\BaseRepository;
use App\Models\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function getModel()
    {
        return Message::class;
    }

    public function getMessageBetweenUser($fromId, $receiveId)
    {
        return $this->model->where([['from_id', $fromId], ['to_id', $receiveId]])->orWhere([['from_id', $receiveId], ['to_id', $fromId]])->get();
    }
}
