<?php
namespace App\Repositories\Advisor;

interface AdvisorRepositoryInterface
{
    public function getMessageSendFromMentor($id);
    public function getMessageSendFromStudent($id);
}
