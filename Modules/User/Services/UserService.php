<?php

namespace Modules\User\Services;


use Illuminate\Http\Response;
use Modules\Auth\Facades\AuthFacade;
use Modules\Auth\Facades\UserProviderFacade;
use Modules\User\Events\CreateScheduleEvent;
use Modules\User\Http\Resources\DashboardResourceCollection;
use Modules\User\Http\Resources\ScheduleResource;
use Modules\User\Http\Resources\ScheduleResourceCollection;
use Modules\User\Models\Schedule;
use Modules\User\Repositories\JobRepository;
use Modules\User\Repositories\ScheduleRepository;
use Modules\User\Repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    private $repo;

    /**
     * @var ScheduleRepository
     */
    private $scheduleRepo;

    /**
     * @var JobRepository
     */
    private $jobRepo;

    public function __construct()
    {
        $this->repo = resolve(UserRepository::class);
        $this->scheduleRepo = resolve(ScheduleRepository::class);
        $this->jobRepo = resolve(JobRepository::class);
    }

    public function dashboard(array $input)
    {
        //        DB::enableQueryLog();
        $rows = $this->jobRepo->allQuery(
        //search input
            '',
            //load relations
            [
                'approvedSchedules',
            ]
        )
            ->orderBy(
                'id',
                isset($input['orderBy']) ? 'desc' : 'asc'
            )
            ->get();
//        dump(DashboardResourceCollection::make($rows)->toJson());
//        $log = DB::getQueryLog();
//        dd($log);

        return DashboardResourceCollection::make($rows);
    }

    /**
     * send response for workers
     */
    public function index()
    {
        $user = AuthFacade::getUser();
        $user->load('schedules');
        return ScheduleResourceCollection::make($user->schedules);
    }

    public function mangerIndex()
    {
        $user = AuthFacade::getUser();
        if (!UserProviderFacade::isManager($user)) {
            exit(Response::HTTP_FORBIDDEN);
        }
        $schedules = $this->scheduleRepo->where('status', Schedule::PENDING_STATUS)->get();
        return ScheduleResource::collection($schedules);
    }

    public function createSchedule(array $input)
    {
        $schedule = $this->scheduleRepo->create($input);
        $schedule->jobs()->attach($input['jobs']);
        $scheduleArray = ScheduleResource::make($schedule)->toArray(request());
        event(new CreateScheduleEvent($scheduleArray));
        return $schedule;
    }

    public function changeScheduleStatus(array $input, int $id)
    {
        $user = AuthFacade::getUser();
        if (!UserProviderFacade::isManager($user)) {
            exit(Response::HTTP_FORBIDDEN);
        }
        return $this->scheduleRepo->update(
            [
                'status' => $input['status'],
                'approved_at' =>
                    $input['status'] === Schedule::APPROVED_STATUS
                        ? now()->toDateString()
                        : null,
            ],
            $id
        );
    }


}
