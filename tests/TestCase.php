<?php

namespace Tests;

use App\Models\User;
use DateTime;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected $header = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->artisan('passport:install');

        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', $this->baseUrl
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $this->user = User::factory()->create();
        $token = $this->user->createToken('Test Token', $this->scopes)->accessToken;
        $this->header['Accept'] = 'application/json';
        $this->header['Authorization'] = 'Bearer '.$token;
    }

    public function get($uri, array $header = [])
    {
        return parent::post($uri, array_merge($this->header, $header));
    }
}
