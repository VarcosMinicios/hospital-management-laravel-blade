<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Http\Services\PeopleService;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    private PeopleService $servicePrimary;

    public function __construct(PeopleService $servicePrimary)
    {
        $this->servicePrimary = $servicePrimary;
    }

    public function getPatient(Request $request)
    {
        return response()->json($this->servicePrimary->getPatient($request->cpf));
    }

    public function index()
    {
        return view('app.people.index')->with($this->servicePrimary->index());
    }

    public function search(Request $request)
    {
        return view('table-body')->with($this->servicePrimary->search($request->search));
    }

    public function create()
    {
        return view('app.people.register')->with($this->servicePrimary->create());
    }

    public function store(PeopleRequest $request)
    {
        $result = $this->servicePrimary->store($request->all());

        return $result['type'] == 'success' ? redirect()->route('patient.index')->with(['success' => $result['msg']]) : redirect()->back()->with(['error' => $result['msg']]);
    }

    public function show($id)
    {
        return view('app.people.register')->with($this->servicePrimary->show($id));
    }

    public function edit($id)
    {
        return view('app.people.register')->with($this->servicePrimary->edit($id));
    }

    public function update(Request $request, $id)
    {
        $result = $this->servicePrimary->update($request->all(), $id);

        return $result['type'] == 'success' ? redirect()->route('patient.index')->with(['success' => $result['msg']]) : redirect()->back()->with(['error' => $result['msg']]);
    }

    public function destroy($id)
    {
        return response()->json($this->servicePrimary->destroy($id));
    }
}
