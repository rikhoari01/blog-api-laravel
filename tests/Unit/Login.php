<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $body = [
            'email' => 'user1@mail.com',
            'password' => '12345678'
        ];

        $this->post('/api/v1/login', $body)->assertStatus(200);
    }

}
