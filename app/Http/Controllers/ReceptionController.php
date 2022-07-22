<?php

namespace App\Http\Controllers;

use App\Http\Services\ReceptionService;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    private ReceptionService $servicePrimary;

    public function __construct(ReceptionService $servicePrimary)
    {
        $this->servicePrimary = $servicePrimary;
    }

    public function index()
    {
        return view('app.reception.index')->with($this->servicePrimary->index());
    }

    public function search(Request $request)
    {
        return view('table-body')->with($this->servicePrimary->search($request->search));
    }

    public function create()
    {
        return view('app.reception.register')->with($this->servicePrimary->create());
    }

    public function store(Request $request)
    {
        return response()->json($this->servicePrimary->store($request->all()));
    }

    public function show($id)
    {
        return view('app.reception.register')->with($this->servicePrimary->show($id));
    }

    public function edit($id)
    {
        return view('app.reception.register')->with($this->servicePrimary->edit($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->servicePrimary->update($request->all(), $id));
    }
}
