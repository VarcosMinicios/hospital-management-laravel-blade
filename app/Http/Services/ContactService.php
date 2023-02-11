<?php

namespace App\Http\Services;

use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function store(array $data): array
    {
        try {

            DB::beginTransaction();

            for ($i = 0; $i < count($data['contact']); $i++) {
                if ($data['contact'][$i]) {
                    $contactToInsert = [
                        'people_id' => $data['people_id'],
                        'type' => $data['contact_type'][$i],
                        'contact' => $data['contact'][$i]
                    ];

                    $contact = new Contact();
                    $contact->fill($contactToInsert);
                    $contact->save();
                }
            }

            DB::commit();

            return ['msg' => 'Sucesso ao cadastrar Contatos', 'type' => 'success', 'id' => $contact->id];

        } catch (Exception $e) {

            DB::rollback();

            return ['msg' => 'Erro ao efetuar Cadastro', 'type' => 'error', 'error' => $e->getMessage()];
        }
    }

    public function update(array $data, int $peopleId): array
    {
        try {

            DB::beginTransaction();

            $contacts = Contact::where('people_id', $peopleId)->get();

            for ($i = 0; $i < count($data['contact']); $i++) {
                if ($data['contact'][$i]) {
                    $contactToInsert = [
                        'people_id' => $peopleId,
                        'type' => $data['contact_type'][$i],
                        'contact' => $data['contact'][$i],
                    ];

                    $contact = $contacts->where('type', $data['contact_type'][$i])->first();

                    if ($contact) {
                        $contact->fill($contactToInsert);
                        $contact->save();
                    } else {
                        $contact = new Contact();
                        $contact->fill($contactToInsert);
                        $contact->save();
                    }
                }
            }

            DB::commit();

            return ['msg' => 'Sucesso ao atualizar contatos', 'type' => 'success'];

        } catch (Exception $e) {

            DB::rollback();

            return ['msg' => 'Erro ao atualizar contatos', 'type' => 'error', 'error' => $e->getMessage()];
        }
    }
}
