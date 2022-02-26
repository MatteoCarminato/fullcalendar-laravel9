<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCalendarRequest;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\CalendarCollection;
use App\Models\Calendar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

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
     * Display the specified resource.
     *
     * @param Calendar $calendar
     * @return Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Calendar $calendar
     * @return Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCalendarRequest $request
     * @param Calendar $calendar
     * @return Response
     */
    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Calendar $calendar
     * @return Response
     */
    public function destroy(Calendar $calendar)
    {
        //
    }

    public function getEvents(GetCalendarRequest $request)
    {
        $date = $request->validated();
        return Calendar::whereDate('start', '>=', $date['start'])
            ->whereDate('end', '<=', $date['end'])
            ->get();
    }
}
