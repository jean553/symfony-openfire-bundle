<?php

namespace jean553\OpenfireBundle\Services;

class OpenfireService
{
    /**
     *
     */
    public function __construct()
    {
        $this->client = new OpenfireClient();
    }

    /**
     *
     */
    public function createUser(
        $username,
        $password
    ) {
    }
}
