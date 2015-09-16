<?php

namespace jean553\OpenfireBundle\Services;

use jean553\OpenfireBundle\Logic\OpenfireClient;

class OpenfireService
{
    /**
     * @var OpenfireClient
     */
    private $client;

    /**
     * @param OpenfireClient $client
     */
    public function __construct(OpenfireClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function createUser(
        $username,
        $password
    ) {

        $this->client->request(
            'post',
            '/users',
            array(
                'username' => $username,
                'password' => $password
            )
        );
    }
}
