<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Visitor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Open ./app/Providers/RouteServiceProvider.php and uncomment the $namespace declaration
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loadViewData()
    {
        $viewData = [];
        $viewData['managers'] = Manager::all();
        $viewData['visitors'] = Visitor::all();
        // Check for flash errors
        if (session('error')) {
            $viewData['error'] = session('error');
            $viewData['errorDetail'] = session('errorDetail');
        }
        // Check for logged on user
        if (session('userName'))
        {
            $viewData['userName'] = session('userName');
            $viewData['userEmail'] = session('userEmail');
            $viewData['userTimeZone'] = session('userTimeZone');
        }
        return $viewData;
    }
}
