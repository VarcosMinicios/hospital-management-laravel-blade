<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Contact;
use App\Models\People;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class PeopleTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_create_a_new_people()
    {
        $people = People::factory()->make();

        $people.= Address::factory()->make()->toArray();
        $people.= Contact::factory()->make()->toArray();

        // $this->post('/people/register', $people)->assertStatus(200);
    }
}
