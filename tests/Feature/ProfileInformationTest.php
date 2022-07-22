<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/profile-information', [
            'telefono' => '123TEST',
            'email' => 'test@example.com',
        ]);

        $this->assertEquals('123TEST', $user->fresh()->telefono);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
