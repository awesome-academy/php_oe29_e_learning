<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use App\Models\Message;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Advisor\AdvisorRepositoryInterface;
use Mockery;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use App\Events\MessageEvent;

class MessageControllerTest extends TestCase
{
    protected $messageMock;
    protected $advisorMock;
    protected $messageController;
    protected $faker;

    public function setUp() : void
    {
        parent::setUp();
        $this->messageMock = Mockery::mock(MessageRepositoryInterface::class);
        $this->advisorMock = Mockery::mock(AdvisorRepositoryInterface::class);
        $this->messageController = new MessageController($this->advisorMock, $this->messageMock);
        $this->faker = Faker::create();
    }

    public function tearDown() : void
    {
        unset($this->messageMock);
        unset($this->advisorMock);
        unset($this->messageController);
        unset($this->faker);
        Mockery::close();
        parent::tearDown();
    }

    public function test_get_message_return_view()
    {
        $id = $this->faker->randomDigit;
        $this->messageMock
            ->shouldReceive('getMessageBetweenUser')
            ->once()
            ->andReturn(new Collection);
        $this->messageMock
            ->shouldReceive('updateWithWhere')
            ->once()
            ->andReturn(true);
        $result = $this->messageController->getMessages($id);
        $dataPassingToView = $result->getData();
        $this->assertIsArray($dataPassingToView);
        $this->assertArrayHasKey('messages', $dataPassingToView);
        $this->assertArrayHasKey('id', $dataPassingToView);
        $this->assertEquals('layouts.message', $result->getName());
    }

    public function test_send_message()
    {
        Event::fake([
            MessageEvent::class,
        ]);
        $data = [
            'receiver_id' => $this->faker->randomDigit,
            'message' => $this->faker->text,
        ];
        $message = factory(Message::class)->make([
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        $messageRequest = Mockery::mock(Request::class)->makePartial();
        $messageRequest->shouldReceive('all')
            ->twice()
            ->andReturn($data);
        $this->messageMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($message);
        $this->messageMock
            ->shouldReceive('updateWithWhere')
            ->once()
            ->andReturn();
        $result = $this->messageController->sendMessage($messageRequest);
        $dataPassingToView = $result->getOriginalContent();
        $this->assertEquals($result->status(), 200);
        $this->assertIsArray($dataPassingToView);
        $this->assertArrayHasKey('from_id', $dataPassingToView);
        $this->assertArrayHasKey('to_id', $dataPassingToView);
        $this->assertArrayHasKey('content', $dataPassingToView);
        $this->assertArrayHasKey('created_at', $dataPassingToView);
    }
}
