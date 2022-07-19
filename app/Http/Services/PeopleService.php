<?php

namespace App\Http\Services;

use App\Models\Address;
use App\Models\People;
use App\Http\Services\ContactService;
use App\Models\Nationality;
use App\Models\SkinColor;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PeopleService
{

    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function getTable(): Builder
    {
        return People::select(
            'people.id',
            'people.mother_name',
            'people.birth_date',
            'people.name'
        );
    }

    public function getPatient(string $cpf): array
    {
        $people = $this->getTable();

        return $people->where('cpf', preg_replace("/\D+/", '', $cpf))->get()->toArray();
    }

    public function index(): array
    {
        $people = $this->getTable();

        $columns = [
            'name' => 'Nome',
            'mother_name' => 'Nome da Mãe',
            'birth_date' => 'Data de Nascimento'
        ];

        return [
            'data' => $people->get()->toArray(),
            'columns' => $columns,
            'prefix' => 'people'
        ];
    }

    public function search($search): array
    {
        $people = $this->getTable();

        if ($search) {
            if (str_contains($search, '/') && strlen($search) == 10) {
                $people = $people->where('people.birth_date', Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d'));
            }

            if (is_string($search)) {
                $people = $people->where('people.mother_name', 'like', "%$search%")
                                    ->orWhere('people.name', 'like', "%$search%");
            }
        }

        $columns = [
            'name' => 'Nome',
            'mother_name' => 'Nome da Mãe',
            'birth_date' => 'Data de Nascimento'
        ];

        return [
            'data' => $people->get()->toArray(),
            'columns' => $columns,
            'url' => route('pessoa.search')
        ];
    }

    public function create(): array
    {
        return [
            'nationalities' => Nationality::all(),
            'states' => State::all(),
            'skinColors' => SkinColor::all()
        ];
    }

    public function store(array $data)
    {
        try {

            DB::beginTransaction();

            isset($data['father_unknown']) ? $data['father_unknown'] = $data['father_unknown'] == 'on' ?: false : null;

            $people = new People();
            $people->fill($data);
            $people->save();

            $data['people_id'] = $people->id;

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

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao cadastrar pessoa', 'type' => 'success', 'route' => route('people.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao efetuar Cadastro', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }

    public function show(int $id): array
    {
        $dependencies = $this->create();
        $dependencies['people'] = People::find($id);
        $dependencies['visualize'] = true;

        return $dependencies;
    }

    public function edit($id): array
    {
        $dependencies = $this->create();
        $dependencies['people'] = People::find($id);

        return $dependencies;
    }

    public function update(array $data, $id)
    {
        try {

            DB::beginTransaction();

            isset($data['father_unknown']) ? $data['father_unknown'] = $data['father_unknown'] == 'on' ?: false : null;

            $people = People::find($id);
            $people->update($data);
            $people->save();

            $address = Address::where('people_id', $id)->first();
            $address->update($data);
            $address->save();

            if (isset($data['contact'][0]) && ($data['contact'][0] || $data['contact'][1] || $data['contact'][3]))
            {
                $result = $this->contactService->update($data, $people->id);

                if ($result['type'] == 'error')
                {
                    throw new Exception($result['msg']);
                }
            }

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao atualizar pessoa', 'type' => 'success', 'route' => route('people.index')];

        } catch (Exception $e) {

            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao atualizar pessoa', 'type' => 'error', 'error' => $e->getMessage()];

        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            People::find($id)->delete();

            DB::commit();

            return ['title' => 'Sucesso!', 'msg' => 'Sucesso ao excluir pessoa', 'type' => 'success'];

        } catch (Exception $e) {
            DB::rollBack();

            return ['title' => 'Erro!', 'msg' => 'Erro ao efetuar exclusão', 'type' => 'error', 'error' => $e->getMessage()];
        }
    }
}
