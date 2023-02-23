<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\TableLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {   $choice = TableLocation::all();
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations','choice'));
    }


    public function create()
    {   $tables = Table::all();
        // where('status', TableStatus::Avalaiable)->get();
        $choice = TableLocation::all();
        $reservations = Reservation::all();
        return view('admin.reservations.create', compact('tables','choice','reservations'));
    }

    public function store(ReservationStoreRequest $request)
    {
        // $table = Table::findOrFail($request->table_id);
        // if ($request->guest_number > $table->guest_number) {
        //     return back()->with('warning', 'Please choose the table base on guests.');
        // }
        // $request_date = Carbon::parse($request->res_date);
        // foreach ($table->reservations as $res) {
        //     if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
        //         return back()->with('warning', 'This table is reserved for this date.');
        //     }
        // }
        Reservation::create($request->validated());
        $choice = TableLocation::all();
        $reservations = Reservation::all();
        return view('admin.reservations.index',compact('choice','reservations'))->with('success', 'Reservation created successfully.');
    }


    public function show($id)
    {
        //
    }


    public function edit(Reservation $reservation )
     {$choice = TableLocation::all();
        $tables = Table::all();
        // $reservation = Reservation::all();
        // dd($reservation);
        return view('admin.reservations.edit', compact('reservation','tables','choice'));
    }


    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {
        // $table = Table::findOrFail($request->table_id);
        // if ($request->guest_number > $table->guest_number) {
        //     return back()->with('warning', 'Please choose the table base on guests.');
        // }
        // $request_date = Carbon::parse($request->res_date);
        // $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        // foreach ($reservations as $res) {
        //     if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
        //         return back()->with('warning', 'This table is reserved for this date.');
        //     }
        // }

        $reservation->update($request->validated());
        $choice = TableLocation::all();
        $reservations = Reservation::all();
        return view('admin.reservations.index',compact('choice','reservations'))->with('success', 'Reservation updated successfully.');
    }


    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        $reservations = Reservation::all();
        return view('admin.reservations.index',compact('reservations'))->with('warning', 'Reservation deleted successfully.');
    }
}
