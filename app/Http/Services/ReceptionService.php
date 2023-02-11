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

class ReceptionService extends Service
{

    protected array $columns = [
        'patient_name' => 'Nome',
        'clinic' => 'Clínica de Internação',
        'professional_name' => 'Profissional',
        'doctor_name' => 'Médico',
        'admission_date' => 'Data de Internação'
    ];

    public function getTable(): Builder
    {
        return Reception::select(
            'receptions.id',
            'patients.name as patient_name',
            'professionals.name as professional_name',
            'p_doctors.name as doctor_name',
            'receptions.clinic',
            'receptions.admission_date'
        )
            ->join('patients', 'patients.id', 'receptions.patient_id')
            ->join('professionals', 'professionals.id', 'receptions.professional_id')
            ->join('doctors', 'doctors.id', 'receptions.doctor_id')
            ->join('professionals as p_doctors', 'p_doctors.id', 'doctors.professional_id')
            ->offset($this->offset)
            ->limit($this->length);;
    }

    public function paginate(int $length): array
    {
        $this->length = $length;

        $receptions = $this->getTable();

        return $this->tableReturn($receptions, 'receptions');
    }

    public function index(): array
    {
        $receptions = $this->getTable();

        return $this->tableReturn($receptions, 'receptions');

    }

    public function search($search): array
    {
        $receptions = $this->getTable();

        if ($search) {
            if (str_contains($search, '/') && strlen($search) == 10) {
                $receptions = $receptions->where('receptions.admission_date', Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d'));
            }

            if (is_numeric($search)) {
                $receptions = $receptions->where('receptions.chart', (int) $search);
            }

            if (is_string($search)) {
                $receptions = $receptions->where('receptions.clinic', 'like', "%$search%")
                                    ->orWhere('patients.name', 'like', "%$search%");
            }
        }

        return $this->tableReturn($receptions, 'receptions');
    }

    public function create(): array
    {
        $professionals = Professional::select('professionals.id', 'name')
            ->leftJoin('doctors', 'doctors.professional_id', 'professionals.id')
            ->leftJoin('nurses', 'nurses.professional_id', 'professionals.id')
            ->whereNull('doctors.id')
            ->whereNull('nurses.id')
            ->get();

        return [
            'professionals' => $professionals,
            'clinics' => Reception::getClinics(),
            'dependencies' => Reception::getDependencies(),
            'doctors' => Doctor::with('professional')->get(),
            'nurses' => Nurse::with('professional')->get()
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

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao cadastrar recepção', 'type' => 'success', 'route' => route('receptions.index')];

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

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao atualizar recepção', 'type' => 'success', 'route' => route('receptions.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao atualizar recepção', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }
}
