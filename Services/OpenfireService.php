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
    public function __construct(
        OpenfireClient $client,
        $config
    ) {
        $this->client = $client;
        $this->config = $config;
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

    /**
     * @param string $chatRoomName
     * @param string $ownerName
     */
    public function createChatRoom(
        $chatRoomName,
        $ownerName
    ) {

        $ownerInfos =
            $ownerName.'@'.$this->config['servicename'].'.'.$this->config['servername'];

        $this->client->request(
            'post',
            '/chatrooms',
            array(
                'roomName' => $chatRoomName,
                'naturalName' => $chatRoomName,
                'description' => $chatRoomName,
                'owners' => array(
                    'owner' => $ownerInfos
                )
            )
        );
    }

    /**
     * @param string $chatRoomName
     * @param string $role
     * @param string $username
     */
    public function addUserInChatRoom(
        $chatRoomName,
        $role,
        $username
    ) {

        $this->client->request(
            'post',
            '/chatrooms/'.$chatRoomName.'/'.$role.'/'.$username,
            array()
        );
    }

    /**
     * @param string $username Openfire username for the user
     *
     * @return string
     */
    public function getUserJID($username)
    {
        return $username.'@'.$this->config['servername'];
    }
}
