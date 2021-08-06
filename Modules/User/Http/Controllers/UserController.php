<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Modules\Auth\Facades\AuthFacade;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Base\Http\ResponderFacade;
use Modules\User\Facades\UserFacade;
use Modules\User\Http\Requests\ChangeScheduleRequest;
use Modules\User\Http\Requests\CreateScheduleRequest;
use Modules\User\Http\Requests\DashboardRequest;

class UserController extends BaseController
{

    public function dashboard(DashboardRequest $request)
    {
        try {
            return UserFacade::dashboard($request->validated());
        } catch (Exception $exception) {
            return $this->handleException(\request(), $exception);
        }
    }

    public function index()
    {
        try {
            return UserFacade::index();
        } catch (Exception $exception) {
            return $this->handleException(\request(), $exception);
        }
    }

    public function mangerIndex()
    {
        try {
            return UserFacade::mangerIndex();
        } catch (Exception $exception) {
            return $this->handleException(\request(), $exception);
        }
    }

    public function createSchedule(CreateScheduleRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = AuthFacade::getUserId();
            if (UserFacade::createSchedule($validated)) {
                return ResponderFacade::created();
            }
            return ResponderFacade::createdFailed();
        } catch (Exception $exception) {
            return $this->handleException(\request(), $exception);
        }
    }


    public function changeScheduleStatus(ChangeScheduleRequest $request, int $id)
    {
        try {
            if (UserFacade::changeScheduleStatus($request->validated(), $id)) {
                return ResponderFacade::updated();
            }
            return ResponderFacade::updatedFailed();
        } catch (Exception $exception) {
            return $this->handleException(\request(), $exception);
        }
    }


}
