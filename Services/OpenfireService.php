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
     *
     * @return json openfire user representation
     */
    public function searchUser($username)
    {

        return $this->client->request(
            'get',
            '/users?search='.$username,
            array()
        );
    }

    /**
     * Create a new user with the given username
     * if this user does not already exists
     *
     * @param string $username
     * @param string $password
     */
    public function createUser(
        $username,
        $password
    ) {

        if (!empty($this->searchUser($username))) {
            return;
        }

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
     * @param string $username
     * @param string $password
     */
    public function editUserPassword(
        $username,
        $password
    ) {

        $this->client->request(
            'put',
            '/users/'.$username,
            array(
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
     * @param string $ownerName
     * @param string $serviceName
     */
    public function createChatRoomWithSpecificService(
        $chatRoomName,
        $ownerName,
        $serviceName
    ) {

        $ownerInfos =
            $ownerName.'@'.$serviceName.'.'.$this->config['servername'];

        $this->client->request(
            'post',
            '/chatrooms?servicename='.$serviceName,
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
     * @param string $chatRoomName
     * @param string $role
     * @param string $username
     * @param string $serviceName
     */
    public function addUserInChatRoomWithSpecificService(
        $chatRoomName,
        $role,
        $username,
        $serviceName
    ) {

        $this->client->request(
            'post',
            '/chatrooms/'.$chatRoomName.'/'.$role.'/'.$username.'?servicename='.$serviceName,
            array()
        );
    }

    /**
     * @param string $chatRoomName
     * @param string $role
     * @param string $username
     */
    public function deleteUserInChatRoom(
        $chatRoomName,
        $role,
        $username
    ) {

        $this->client->request(
            'delete',
            '/chatrooms/'.$chatRoomName.'/'.$role.'/'.$username,
            array()
        );
    }

    /**
     * @param string $chatRoomName
     */
    public function deleteChatRoom($chatRoomName)
    {

        $this->client->request(
            'delete',
            '/chatrooms/'.$chatRoomName,
            array()
        );
    }

    /**
     * @param string $chatRoomName
     * @param string $serviceName
     */
    public function deleteChatRoomWithSpecificService(
        $chatRoomName,
        $serviceName
    ) {

        $this->client->request(
            'delete',
            '/chatrooms/'.$chatRoomName.'?servicename='.$serviceName,
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
