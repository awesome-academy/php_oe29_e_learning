<?php

namespace Tests\Unit\Controller;

use Tests\TestCase;
use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Mockery;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;
use Illuminate\Http\RedirectResponse;
use Exception;

class CourseControllerTest extends TestCase
{
    protected $courseMock;
    protected $courseController;

    public function setUp() : void
    {
        parent::setUp();
        $this->courseMock = Mockery::mock(CourseRepositoryInterface::class);
        $this->courseController = new CourseController($this->courseMock);
    }

    public function tearDown() : void
    {
        $this->courseController = null;
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_return_view()
    {
        $this->courseMock
            ->shouldReceive('getAll')
            ->with(['image'], config('paginate.course_number'))
            ->once()
            ->andReturn(new Collection);
        $result = $this->courseController->index();
        $dataPassingToView = $result->getData();
        $this->assertIsArray($dataPassingToView);
        $this->assertArrayHasKey('courses', $dataPassingToView);
        $this->assertEquals('admin.component.course', $result->getName());
    }

    public function test_create_return_view()
    {
        $result = $this->courseController->create();
        $this->assertEquals('admin.component.add_course', $result->getName());
    }

    public function test_it_store_new_course_success()
    {
        $data = [
            'name' => 'test_success',
            'photo' => UploadedFile::fake()->image('test.jpg'),
            'description' => 'test_description_success',
        ];
        $courseRequest = Mockery::mock(CourseRequest::class)->makePartial();
        $courseRequest->shouldReceive('all')->once()->andReturn($data);
        $course = factory(Course::class)->make();
        $course->id = config('title.test_id');
        $this->courseMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($course);
        $this->courseMock
            ->shouldReceive('createPolymorphic')
            ->once()
            ->andReturn(true);
        $result = $this->courseController->store($courseRequest);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.created_success'), $alert);
    }

    public function test_it_store_new_course_fail()
    {
        $data = [
            'name' => 'test_fail',
            'photo' => UploadedFile::fake()->image('test.jpg'),
            'description' => 'test_description_fail',
        ];
        $courseRequest = Mockery::mock(CourseRequest::class)->makePartial();
        $courseRequest->shouldReceive('all')->once()->andReturn($data);
        $this->courseMock
            ->shouldReceive('create')
            ->once()
            ->andReturn(false);
        $result = $this->courseController->store($courseRequest);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.created_fail'), $alert);
    }

    public function test_it_show_course()
    {
        $id = config('title.test_id');
        $this->courseMock
            ->shouldReceive('loadRelations')
            ->once()
            ->andReturn(new Collection);
        $result = $this->courseController->show($id);
        $dataPassingToView = $result->getData();
        $this->assertIsArray($dataPassingToView);
        $this->assertArrayHasKey('course', $dataPassingToView);
        $this->assertEquals('admin.component.show_course', $result->getName());
    }

    public function test_it_edit_course()
    {
        $course = factory(Course::class)->make();
        $course->id = config('title.test_id');
        $this->courseMock
            ->shouldReceive('find')
            ->with($course->id)
            ->once()
            ->andReturn($course);
        $result = $this->courseController->edit($course->id);
        $dataPassingToView = $result->getData();
        $this->assertIsArray($dataPassingToView);
        $this->assertArrayHasKey('course', $dataPassingToView);
        $this->assertEquals('admin.component.edit_course', $result->getName());
    }

    public function test_it_update_course_with_image()
    {
        $course = factory(Course::class)->make();
        $course->id = config('title.test_id');
        $data = [
            'name' => 'test',
            'photo' => UploadedFile::fake()->image('test.jpg'),
            'description' => 'test_description',
        ];
        $courseRequest = Mockery::mock(CourseRequest::class)->makePartial();
        $courseRequest->shouldReceive('all')->twice()->andReturn($data);
        $this->courseMock
            ->shouldReceive('update')
            ->once()
            ->andReturn(true);
        $this->courseMock
            ->shouldReceive('updatePolymorphic')
            ->once()
            ->andReturn(true);
        $result = $this->courseController->update($courseRequest, $course);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.edited_success'), $alert);
    }

    public function test_it_update_course_without_image()
    {
        $course = factory(Course::class)->make();
        $course->id = config('title.test_id');
        $data = [
            'name' => 'test',
            'description' => 'test_description',
        ];
        $courseRequest = Mockery::mock(CourseRequest::class)->makePartial();
        $courseRequest->shouldReceive('all')->twice()->andReturn($data);
        $this->courseMock
            ->shouldReceive('update')
            ->once()
            ->andReturn(false);
        $result = $this->courseController->update($courseRequest, $course);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.edited_fail'), $alert);
    }

    public function test_it_destroy_course_success()
    {
        $id = config('title.test_id');
        $this->courseMock
            ->shouldReceive('delete')
            ->with($id)
            ->once()
            ->andReturn(true);
        $result = $this->courseController->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.delete_success'), $alert);
    }

    public function test_it_destroy_course_fail()
    {
        $id = config('title.test_id');
        $this->courseMock
            ->shouldReceive('delete')
            ->with($id)
            ->once()
            ->andReturn(false);
        $result = $this->courseController->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('courses.index'), $result->headers->get('Location'));
        $alert = json_decode($result->getSession()->get('alert.config'))->title;
        $this->assertEquals(trans('label.delete_fail'), $alert);
    }
}
