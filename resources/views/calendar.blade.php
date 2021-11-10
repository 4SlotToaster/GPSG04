@extends('layout')

@section('content')
    <h1>Calendar</h1>
    <h2>{{ $dateRange }}</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Organizer</th>
            <th scope="col">Subject</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
        </tr>
        </thead>
        <tbody>
        @isset($events)
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->getOrganizer()->getEmailAddress()->getName() }}</td>
                    <td>{{ $event->getSubject() }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->getStart()->getDateTime())->format('n/j/y g:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->getEnd()->getDateTime())->format('n/j/y g:i A') }}</td>
                    <td>
                        <form>
                            <label>
                                Add License Plate:
                                <input name="addPlate" type="text" />
                            </label>
                            <button type="submit"> Add </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
