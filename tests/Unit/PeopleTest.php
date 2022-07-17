<?php

namespace Tests\Unit;

use App\Models\People;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class PeopleTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_create_a_new_people()
    {
        $people = People::factory()->make();

        $this->post('/people/register', $people->toArray());

        $this->assertDatabaseHas('people', $people->toArray());
    }
}
