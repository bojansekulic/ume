<?php

namespace Vanguard\Http\Controllers\Web;

use jdavidbakr\MailTracker\Model\SentEmail;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var ActivityRepository
     */
    private $activities;

    /**
     * DashboardController constructor.
     * @param UserRepository $users
     * @param ActivityRepository $activities
     */
    public function __construct(UserRepository $users, ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
    }

    /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            return $this->adminDashboard();
        }

        return $this->defaultDashboard();
    }

    /**
     * Displays dashboard for admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function adminDashboard()
    {
        $usersPerMonth = $this->users->countOfNewUsersPerMonth(
            Carbon::now()->subYear(),
            Carbon::now()
        );

        $stats = [
            'total' => $this->users->count(),
            'new' => $this->users->newUsersCount(),
            'banned' => $this->users->countByStatus(UserStatus::BANNED),
            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ];

        $latestRegistrations = $this->users->latest(7);

        return view('dashboard.admin', compact('stats', 'latestRegistrations', 'usersPerMonth'));
    }

    /**
     * Displays default dashboard for non-admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function defaultDashboard()
    {
        $activities = $this->activities->userActivityForPeriod(
            Auth::user()->id,
            Carbon::now()->subWeeks(2),
            Carbon::now()

        )->toArray();

//        $clicks=SentEmail::where('clicks','>',0)->get();>

        $clicks=SentEmail::where('user_id',Auth::id())->where('clicks','>',0)->get()->count();

        $opens=SentEmail::where('user_id',Auth::id())->where('opens','>',0)->get()->count();

        $submited=SentEmail::where('user_id',Auth::id())->where('submited','>',0)->get()->count();

        $all= SentEmail::all()->where('user_id',Auth::id())->count();

        return view('dashboard.default', compact('activities','all','clicks','opens','submited'));
    }
}
