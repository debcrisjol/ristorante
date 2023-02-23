<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;
use App\Models\TableLocation;
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

    { $tables = Table::all();
        $choice = TableLocation::all();
        return view('admin.tables.create',compact('choice','tables'));
    }

    public function store(TableStoreRequest $request)
    {
        Table::create([
            'name' => $request->name,
            'guest_number' => $request->guest_number,

            'location' => $request->location,
        ]);
        $tables = Table::all();
        return view('admin.tables.index',compact('tables'))->with('success', 'Table created successfully.');
    }


    public function show($id)
    {
        //
    }


    public function edit(Table $table)
    { $tables = Table::all();
        $choice = TableLocation::all();

        return view('admin.tables.edit', compact('table','tables','choice'));
    }


    public function update(TableStoreRequest $request, Table $table)
    {
        $table->update($request->validated());
        $tables = Table::all();
        return view('admin.tables.index',compact('tables'))->with('success', 'Table updated successfully.');
    }

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
        $tables = Table::all();
        return view('admin.tables.index',compact('tables'))->with('danger', 'Table daleted successfully.');
    }
}
