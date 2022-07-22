<?php

namespace App\Http\Services;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Professional;
use App\Models\Reception;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReceptionService
{

    private array $columns = [
        'people_name' => 'Nome',
        'clinic' => 'Clínica de Internação',
        'professional_name' => 'Profissional',
        'doctor_name' => 'Médico',
        'admission_date' => 'Data de Internação'
    ];

    public function getTable(): Builder
    {
        return Reception::select(
            'receptions.id',
            'receptions.people_id',
            'receptions.professional_id',
            'receptions.doctor_id',
            'receptions.clinic',
            'receptions.admission_date'
        );
    }

    public function index(): array
    {
        $receptions = $this->getTable();

        return [
            'data' => $receptions->get()->toArray(),
            'columns' => $this->columns,
            'prefix' => 'reception'
        ];
    }


    public function create(): array
    {
        return [
            'professionals' => Professional::select('id', 'people_id')->get(),
            'clinics' => Reception::getClinics(),
            'dependencies' => Reception::getDependencies(),
            'doctors' => Doctor::all(),
            'nurses' => Nurse::all()
        ];
    }

    public function search($search): array
    {
        $receptions = $this->getTable();

        if ($search) {
            if (str_contains($search, '/') && strlen($search) == 10) {
                $receptions = $receptions->where('receptions.admission_date', Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d'));
            }

            if (is_numeric($search)) {
                $receptions = $receptions->where('patients.chart', (int) $search);
            }

            if (is_string($search)) {
                $receptions = $receptions->where('receptions.clinic', 'like', "%$search%")
                                    ->orWhere('people.name', 'like', "%$search%");
            }
        }

        return [
            'data' => $receptions->get()->toArray(),
            'columns' => $this->columns,
            'url' => route('reception.search'),
            'prefix' => 'reception'
        ];
    }

    public function store(array $data): array
    {
        try {

            DB::beginTransaction();

            $reception = new Reception();
            $reception->fill($data);
            $reception->save();

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao cadastrar recepção', 'type' => 'success', 'route' => route('reception.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao efetuar Cadastro', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }

    public function show(int $id): array
    {
        $dependencies = $this->create();
        $dependencies['reception'] = Reception::find($id);
        $dependencies['visualize'] = true;

        return $dependencies;
    }

    public function edit($id): array
    {
        $dependencies = $this->create();
        $dependencies['reception'] = Reception::find($id);

        return $dependencies;
    }

    public function update(array $data, $id): array
    {
        try {

            DB::beginTransaction();

            $reception = Reception::find($id);
            $reception->fill($data);
            $reception->save();

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao atualizar recepção', 'type' => 'success', 'route' => route('reception.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao atualizar recepção', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }
}
