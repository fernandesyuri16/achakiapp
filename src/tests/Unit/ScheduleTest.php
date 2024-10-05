<?php

namespace Tests\Unit;

use App\Models\Employees;
use Tests\TestCase;
use App\Models\User;
use App\Models\Schedules;
use App\Models\Services;
use App\Services\SchedulesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    protected SchedulesService $scheduleService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->scheduleService = new SchedulesService();
    }

    public function test_creates_scheduling_successfully(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $schedulingData = [
            'user_id' => User::factory()->create()->id,
            'service_id' => Services::factory()->create()->id,
            'employee_id' => Employees::factory()->create()->id,
            'schedule_date' => fake()->dateTimeBetween('now', '+1 day'),
        ];

        $response = $this->scheduleService->createSchedule($schedulingData);

        $this->assertEquals(Response::HTTP_CREATED, $response['code']);
        $this->assertArrayHasKey('id', $response['response']['data']);
    }

    public function test_gets_scheduling_successfully(): void
    {
        $scheduling = Schedules::factory()->create();

        $response = $this->scheduleService->getScheduleById($scheduling->id);

        $this->assertEquals(Response::HTTP_OK, $response['code']);
        $this->assertArrayHasKey('id', $response['response']['data']);
    }

    public function test_updates_scheduling_successfully(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $schedulingData = [
            'user_id' => $user->id,
        ];

        $scheduling = Schedules::factory()->create($schedulingData);

        $newDate = '2024-09-24 15:00:00';

        $response = $this->scheduleService->updateSchedule($scheduling->id, ['schedule_date' => $newDate]);

        $this->assertEquals(Response::HTTP_OK, $response['code']);
        $this->assertEquals($newDate, $response['response']['data']['schedule_date']);
    }

    public function test_deletes_scheduling_successfully(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $schedulingData = [
            'user_id' => $user->id,
        ];

        $scheduling = Schedules::factory()->create($schedulingData);

        $response = $this->scheduleService->deleteSchedule($scheduling->id);

        $this->assertEquals(Response::HTTP_OK, $response['code']);
        $this->assertEquals('Schedule successfully deleted!', $response['response']['data']);
    }

    public function test_error_if_scheduling_not_found_when_getting_scheduling(): void
    {
        $response = $this->scheduleService->getScheduleById(123);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response['code']);
        $this->assertEquals("Schedule doesn't exists.", $response['response']['data']);
    }

    public function test_error_if_scheduling_not_found_when_updating_scheduling(): void
    {
        $response = $this->scheduleService->updateSchedule(123, ['description' => 'aparar a barba']);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response['code']);
        $this->assertEquals("Schedule doesn't exists.", $response['response']['data']);
    }

    public function test_error_if_scheduling_not_found_when_deleting_scheduling(): void
    {
        $response = $this->scheduleService->deleteSchedule(123);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response['code']);
        $this->assertEquals("Schedule doesn't exists.", $response['response']['data']);
    }

    public function test_error_if_user_doesnt_have_permission_when_updating_scheduling(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $schedulingData = [
            'user_id' => $user->id,
        ];

        $scheduling = Schedules::factory()->create($schedulingData);

        $secondUser = User::factory()->create();
        Sanctum::actingAs($secondUser);

        $response = $this->scheduleService->updateSchedule($scheduling->id, ['schedule_date' => 'aparar a barba']);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response['code']);
        $this->assertEquals("You don't have permission to perform this action.", $response['response']['data']);
    }

    public function test_error_if_user_doesnt_have_permission_when_deleting_scheduling(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $schedulingData = [
            'user_id' => $user->id,
        ];

        $scheduling = Schedules::factory()->create($schedulingData);

        $secondUser = User::factory()->create();
        Sanctum::actingAs($secondUser);

        $response = $this->scheduleService->deleteSchedule($scheduling->id);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response['code']);
        $this->assertEquals("You don't have permission to perform this action.", $response['response']['data']);
    }
}