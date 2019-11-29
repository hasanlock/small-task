<?php
namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use GuzzleHttp\Client;
use Exception;

class UserService
{
    protected $users;
    /**
     * __construct Create the service object
     *
     * @param string $mdlCls the Task model to be used,
     *                           default is Task model
     */
    public function __construct()
    {
        $this->users = new Collection;
    }

    /**
     * find function to find user array from an id
     *
     * @param integer $id
     * @return array
     */
    public function find(int $id): array
    {
        try {
            $this->fetch();
            $user = [];
            $user = $this->users
                ->first(function ($obj) use ($id) {
                    if ($obj['id'] == $id) {
                        return $obj;
                    }
                });

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * check function to check email for an id given
     *
     * @param integer $id
     * @param string $email
     * @return bool
     */
    public function check(int $id, string $email): bool
    {
        $user = $this->find($id);
        if ($user == null) {
            return false;
        }

        return $user['email'] == $email;
    }

    public function exceptionAwareCheck(int $id, string $email): bool
    {
        try {
            $return = $this->check($id, $email);
            if (!$return) {
                throw new Exception("User not found", 500);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * fetch function to fetch configured User service URL
     * and set User collection to users object
     *
     * @return void
     */
    public function fetch(): void
    {
        try {
            $client = new Client;

            $response = $client->request('GET', config('defaults.configs.user_api'));

            $responseJson = (string) $response->getBody();
            $responseArray = json_decode($responseJson, true);

            $this->users = new Collection($responseArray['data']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
