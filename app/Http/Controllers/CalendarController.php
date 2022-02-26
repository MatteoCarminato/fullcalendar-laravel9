<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Models\Calendar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $events = Calendar::all();
        return view('welcome', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCalendarRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
}
