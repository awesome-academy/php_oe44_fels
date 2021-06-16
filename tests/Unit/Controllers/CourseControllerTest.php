<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\Auth\Admin\CourseAdminController;
use App\Models\Course;
use Tests\TestCase;
use Mockery as m;
use Illuminate\Database\Connection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class CourseControllerTest extends TestCase
{
    protected $db;
    protected $courseMock;

    public function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->db = m::mock(
                Connection::class . '[select,update,insert,delete]',
                [m::mock(\PDO::class)]
            );

            $manager = $this->app['db'];
            $manager->setDefaultConnection('mock');

            $r = new \ReflectionClass($manager);
            $p = $r->getProperty('connections');
            $p->setAccessible(true);
            $list = $p->getValue($manager);
            $list['mock'] = $this->db;
            $p->setValue($manager, $list);

            $this->courseMock = m::mock(Course::class . '[update, delete]');
        });

        parent::setUp();
    }

    public function test_index_returns_view()
    {
        $controller = new CourseAdminController();
        $this->db->shouldReceive('select')->once()->withArgs([
            'select count(*) as aggregate from "courses"',
            [],
            m::any(),
        ])->andReturn((object) ['aggregate' => 10]);

        $this->db->shouldReceive('select')->once()->withArgs([
            'select * from "topics"',
            [],
            m::any(),
        ])->andReturn(true);

        $view = $controller->index();
        $this->assertEquals('auth.admin.courses', $view->getName());
        $this->assertArrayHasKey('courses', $view->getData());
        $this->assertArrayHasKey('topics', $view->getData());
    }

    public function test_it_stores_new_course_success()
    {
        $controller = new CourseAdminController();

        $data = [
            'name' => 'Family',
            'described' => 'Nothing...',
            'topic_id' => 1,
        ];

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(1);
        $this->db->shouldReceive('insert')->once()
            ->withArgs([
                'insert into "courses" ("name", "described", "topic_id", "updated_at", "created_at") values (?, ?, ?, ?, ?)',
                m::on(function ($arg) {
                    return is_array($arg) &&
                        $arg['name'] = 'Family' && $arg['described'] = 'Nothing...' && $arg['topic_id'] = 1;
                })
            ])->andReturn(true);

        /** @var RedirectResponse $response */
        $response = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('courses.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('insert_success_course'), $response->getSession()->get('status'));
    }

    public function test_it_stores_new_course_fail()
    {
        $controller = new CourseAdminController();

        $data = [
            'name' => 'Family',
            'described' => 'Nothing...',
            'topic_id' => 1,
        ];

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(1);
        $this->db->shouldReceive('insert')->once()
            ->withArgs([
                'insert into "courses" ("name", "described", "topic_id", "updated_at", "created_at") values (?, ?, ?, ?, ?)',
                m::on(function ($arg) {
                    return is_array($arg) &&
                        $arg['name'] = 'Family' && $arg['described'] = 'Nothing...' && $arg['topic_id'] = 1;
                })
            ])
            ->andReturnUsing(function () {
                throw new QueryException('', [], new \Exception);
            });

        /** @var RedirectResponse $response */
        $response = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('courses.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('insert_fail_course'), $response->getSession()->get('status'));
    }

    public function test_update_existing_course_success()
    {
        $controller = new CourseAdminController();

        $data = [
            'id' => 1,
            'name' => 'new name',
            'described' => 'new described',
            'topic_id' => 1,
        ];

        $course = $this->courseMock->forceFill(['id' => 1, 'name' => 'old name', 'described' => 'old described', 'topic_id' => 1]);

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $this->courseMock->shouldReceive('update')->once()->withArgs([
            m::on(function($arg) {
                return is_array($arg);
            }
        )])->andReturn(true);

        $response = $controller->update($request, $course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('courses.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('update_success_course'), $response->getSession()->get('status'));
    }

    public function test_update_existing_course_fail()
    {
        $controller = new CourseAdminController();

        $data = [
            'id' => 1,
            'name' => 'new name',
            'described' => 'new described',
            'topic_id' => 1,
        ];

        $course = $this->courseMock->forceFill(['id' => 1, 'name' => 'old name', 'described' => 'old described', 'topic_id' => 1]);

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $this->courseMock->shouldReceive('update')->once()->withArgs([
            m::on(function($arg) {
                return is_array($arg);
            }
        )])->andThrow(new QueryException('', [], new \Exception));

        $response = $controller->update($request, $course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('courses.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('update_fail_course'), $response->getSession()->get('status'));
    }
    
    public function test_destroy_existing_course()
    {
        $controller = new CourseAdminController();

        $data = [
            'id' => 1,
            'name' => 'Family',
            'described' => 'Family described',
            'topic_id' => 1,
        ];

        $course = $this->courseMock->forceFill($data);

        $this->courseMock->shouldReceive('delete')->once()->andReturn(true);

        $response = $controller->destroy($course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('courses.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('delete_success_course'), $response->getSession()->get('status'));
    }
}
