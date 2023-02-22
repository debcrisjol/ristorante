<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class TableController extends Controller
{
    
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }


    public function create()
    {
        return view('admin.tables.create');
    }

    // public function store(TableStoreRequest $request)
    // {
    //     Table::create([
    //         'name' => $request->name,
    //         'guest_number' => $request->guest_number,
    //         'status' => $request->status,
    //         'location' => $request->location,
    //     ]);

    //     return to_route('admin.tables.index')->with('success', 'Table created successfully.');
    // }


    public function show($id)
    {
        //
    }


    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(TableStoreRequest $request, Table $table)
    // {
    //     $table->update($request->validated());

    //     return view('admin.tables.index')->with('success', 'Table updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->reservations()->delete();
        $table->delete();

        return view('admin.tables.index')->with('danger', 'Table daleted successfully.');
    }
}
