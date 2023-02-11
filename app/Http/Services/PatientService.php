<?php

namespace App\Http\Services;

use App\Models\Address;
use App\Models\People;
use App\Http\Services\ContactService;
use App\Models\Nationality;
use App\Models\Patient;
use App\Models\SkinColor;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PatientService extends Service
{

    protected array $columns = [
        'name' => 'Nome',
        'cns' => 'CNS',
        'mother_name' => 'Nome da Mãe',
        'birth_date' => 'Data de Nascimento'
    ];

    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function getTable(): Builder
    {
        return Patient::select(
            'patients.id',
            'patients.name',
            'patients.people_id',
            'people.cns',
            'people.mother_name',
            'people.birth_date'
        )
            ->join('people', 'people.id', 'patients.people_id')
            ->offset($this->offset)
            ->limit($this->length);
    }

    public function getPatient(string $cpf): array
    {
        $patients = $this->getTable();

        return $patients->where('cpf', preg_replace("/\D+/", '', $cpf))->get()->toArray();
    }

    public function index(): array
    {
        $patients = $this->getTable();

        return $this->tableReturn($patients, 'patients');
    }

    public function search(string $search): array
    {
        $patients = $this->getTable();

        if ($search) {
            if (str_contains($search, '/') && strlen($search) == 10) {
                $patients->where('people.birth_date', Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d'));
            }

            if (is_string($search)) {
                $patients->where('people.mother_name', 'like', "%($search)%")
                                    ->orWhere('patients.name', 'like', "%$search%");
            }

            if (is_numeric($search)) {
                $patients->where('people.cns', $this->removeMask($search));
            }
        }

        return $this->tableReturn($patients, 'patients');
    }

    public function paginate(int $length): array
    {
        $this->length = $length;

        $patients = $this->getTable();

        return $this->tableReturn($patients, 'patients');
    }

    public function create(): array
    {
        return [
            'nationalities' => Nationality::all(),
            'states' => State::all(),
            'skinColors' => SkinColor::all()
        ];
    }

    public function store(array $data): array
    {
        try {

            DB::beginTransaction();

            isset($data['father_unknown']) ? $data['father_unknown'] = $data['father_unknown'] == 'on' ?: false : null;

            $people = new People();
            $people->fill($data);
            $people->save();

            $data['people_id'] = $people->id;

            $patient = new Patient();
            $patient->fill($data);
            $patient->save();

            $address = new Address();
            $address->fill($data);
            $address->save();

            if (isset($data['contact'][0]) && ($data['contact'][0] || $data['contact'][1] || $data['contact'][3]))
            {
                $result = $this->contactService->store($data);

                if ($result['type'] == 'error')
                {
                    throw new Exception($result['msg']);
                }
            }

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao cadastrar pessoa', 'type' => 'success', 'route' => route('patients.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao efetuar Cadastro', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }

    public function show(int $id): array
    {
        $dependencies = $this->create();
        $dependencies['patient'] = Patient::find($id);
        $dependencies['visualize'] = true;

        return $dependencies;
    }

    public function edit($id): array
    {
        $dependencies = $this->create();
        $dependencies['patient'] = Patient::find($id);

        return $dependencies;
    }

    public function update(array $data, int $id): array
    {
        try {

            DB::beginTransaction();

            isset($data['father_unknown']) ? $data['father_unknown'] = $data['father_unknown'] == 'on' ?: false : null;

            $patient = Patient::findOrFail($id);
            $patient->people->update($data);
            $patient->people->address->update($data);
            $patient->update($data);
            $patient->save();

            if (isset($data['contact'][0]) && ($data['contact'][0] || $data['contact'][1] || $data['contact'][3]))
            {
                $result = $this->contactService->update($data, $patient->people_id);

                if ($result['type'] == 'error')
                {
                    throw new Exception($result['msg']);
                }
            }

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao atualizar pessoa', 'type' => 'success', 'route' => route('patients.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao atualizar pessoa', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }

    public function destroy(int $id): array
    {
        try {
            DB::beginTransaction();

            Patient::findOrFail($id)->delete();

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao excluir pessoa', 'type' => 'success'];

        } catch (Exception $e) {
            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao efetuar exclusão', 'type' => 'error', 'error' => $e->getMessage()];
        }
    }
}
