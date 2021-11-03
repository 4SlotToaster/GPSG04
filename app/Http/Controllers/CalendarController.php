<?php

namespace App\Http\Controllers;

use App\Providers\_AzureProvider;
use App\TimeZones\TimeZones;
use App\TokenStore\_TokenCache;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Http\Request;

class CalendarController extends Controller {

    private $tokenCache;
    private $graph;

    public function __construct(Graph $graph, _TokenCache $tokenCache) {
        $this->tokenCache = $tokenCache;
        $this->graph = $graph;
    }

    public function calendar()
    {
        try {
            $viewData = $this->loadViewData();

            // Get user's timezone
            $timezone = TimeZones::getTzFromWindows($viewData['userTimeZone']);

            // Get start and end of week
            $startOfWeek = new \DateTimeImmutable('sunday -1 week', $timezone);
            $endOfWeek = new \DateTimeImmutable('sunday', $timezone);

            $viewData['dateRange'] = $startOfWeek->format('M j, Y') . ' - ' . $endOfWeek->format('M j, Y');

            $queryParams = array(
                'startDateTime' => $startOfWeek->format(\DateTimeInterface::ISO8601),
                'endDateTime' => $endOfWeek->format(\DateTimeInterface::ISO8601),
                // Only request the properties used by the app
                '$select' => 'subject,organizer,start,end',
                // Sort them by start time
                '$orderby' => 'start/dateTime',
            );

            // Append query parameters to the '/me/calendarView' url
            $getEventsUrl = '/me/calendarView?' . http_build_query($queryParams);

            $this->graph->setAccessToken($this->tokenCache->getAccessToken());
            $events = $this->graph->createRequest('GET', $getEventsUrl)
                // Add the user's timezone to the Prefer header
                ->addHeaders(array(
                    'Prefer' => 'outlook.timezone="' . $viewData['userTimeZone'] . '"'
                ))
                ->setReturnType(Model\Event::class)
                ->execute();

            $viewData['events'] = $events;
            return view('calendar', $viewData);
        }
        catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error requesting access token')
                ->with('errorDetail', json_encode($e->getResponseBody()));
        }
    }
}
