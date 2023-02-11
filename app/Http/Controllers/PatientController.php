<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private PatientService $servicePrimary;

    public function __construct(PatientService $servicePrimary)
    {
        $this->servicePrimary = $servicePrimary;
    }

    public function getPatient(Request $request)
    {
        return response()->json($this->servicePrimary->getPatient($request->cpf));
    }

    public function index()
    {
        return view('app.patients.index')->with($this->servicePrimary->index());
    }

    public function search(Request $request)
    {
        return view('table-body')->with($this->servicePrimary->search($request->search ?? ''));
    }

    public function paginate(int $length)
    {
        return view('table-body')->with($this->servicePrimary->paginate($length));
    }

    public function create()
    {
        return view('app.patients.register')->with($this->servicePrimary->create());
    }

    public function store(PatientRequest $request)
    {
        $result = $this->servicePrimary->store($request->all());

        return $result['type'] == 'success' ? redirect()->route('patients.index')->with(['success' => $result['msg']]) : redirect()->back()->with(['error' => $result['msg']]);
    }

    public function show($id)
    {
        return view('app.patients.register')->with($this->servicePrimary->show($id));
    }

    public function edit($id)
    {
        return view('app.patients.register')->with($this->servicePrimary->edit($id));
    }

    public function update(Request $request, $id)
    {
        $result = $this->servicePrimary->update($request->all(), $id);

        return $result['type'] == 'success' ? redirect()->route('patients.index')->with(['success' => $result['msg']]) : redirect()->back()->with(['error' => $result['msg']]);
    }

    public function destroy($id)
    {
        return response()->json($this->servicePrimary->destroy($id));
    }
}
