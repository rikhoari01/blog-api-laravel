<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $scopes = ['restricted-scope'];
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_post()
    {
        // $body = [
        //     'email' => 'user1@mail.com',
        //     'password' => '12345678'
        // ];
        // $token = $this->postJson('/api/v1/login', $body)->assertStatus(200)->decodeResponseJson()['token'];

        // $header = [
        //     'Authorization' => 'Bearer '.$token
        // ];

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'category_id' => $this->faker->randomDigitNotNull,
            'user_id' => $this->faker->randomDigitNotNull,
        ];

        // $user = User::factory()->create();

        $this->post('api/v1/post', $data)->assertStatus(200);
    }
}
