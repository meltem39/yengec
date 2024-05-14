<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function db_connection(){
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
        ]);
    }

    public function register_and_login(){
        $data = [
            'email' => 'user@yengec.com',
            'password' => "123456",
        ];
        $this->json('POST', 'api/user/register', $data);
        $response = $this->json('POST', 'api/user/login', $data);
        return $response;
    }

    public function create_integration($user_id, $token){
        $item = [
            "user_id" => $user_id,
            "marketplaces" => "trendyol",
            "username" => "Meltem Özkan",
            "password" =>  "123456"
        ];

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->json('POST', 'api/integration', $item);
        return $response;
    }

    // TEST
    public function test_list_integration()
    {
        $this->db_connection();

        $login = $this->register_and_login();

        $token = $login["data"]["token"];

        $response = $this
            ->withHeaders(['Authorization'=>'Bearer '.$token])
            ->json('GET', 'api/integration')
            ->assertStatus(200);
    }


    public function test_add_integration()
    {
        // Create personel access token
        $this->db_connection();
        // Create new user and token
        $login = $this->register_and_login();

        $token = $login["data"]["token"];
        $user_id = $login["data"]["id"];

        $item = [
            "user_id" => $user_id,
            "marketplaces" => "trendyol",
            "username" => "Meltem Özkan",
            "password" =>  "123456"
        ];

        $response = $this
            ->withHeaders(['Authorization'=>'Bearer '.$token])
            ->json('POST', 'api/integration', $item)
            ->assertStatus(200);

    }

    public function test_update_integration()
    {
        // Create personel access token
        $this->db_connection();
        // Create new user and token
        $login = $this->register_and_login();

        $token = $login["data"]["token"];
        $user_id = $login["data"]["id"];

        // Create new integration
        $integration = $this->create_integration($user_id, $token);

        $id = $integration["data"]["id"];

        $item = [
            "marketplaces" => "n11",
            "username" => "Meltem Özkan",
        ];
        $response = $this
            ->withHeaders(['Authorization'=>'Bearer '.$token])
            ->json('PUT', 'api/integration/'.$id, $item)
            ->assertStatus(200);


    }

    public function test_delete_integration()
    {
        // Create personel access token
        $this->db_connection();
        // Create new user and token
        $login = $this->register_and_login();

        $token = $login["data"]["token"];
        $user_id = $login["data"]["id"];


        // Create new integration
        $integration = $this->create_integration($user_id, $token);

        $id = $integration["data"]["id"];


        $response = $this
            ->withHeaders(['Authorization'=>'Bearer '.$token])
            ->json('DELETE', 'api/integration/'.$id)
            ->assertStatus(200);

    }
}
