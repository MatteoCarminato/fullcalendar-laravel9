<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCalendarRequest;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\CalendarCollection;
use App\Http\Resources\CalendarResource;
use App\Models\Calendar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCalendarRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCalendarRequest $request)
    {
        Calendar::create($request->validated());
        return to_route('calendar.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Calendar $calendar
     * @return CalendarResource
     */
    public function edit(Calendar $calendar)
    {
        return new CalendarResource($calendar);
    }

    public function getEvents(GetCalendarRequest $request)
    {
        $date = $request->validated();
        return Calendar::whereDate('start', '>=', $date['start'])
            ->whereDate('end', '<=', $date['end'])
            ->get();
    }

    public function updateEvents(UpdateCalendarRequest $request)
    {
        Calendar::where('id', $request->id)
            ->update($request->validated());
        return to_route('calendar.index');
    }
}
