<?php

namespace jean553\OpenfireBundle\Services;

class DummyOpenfireService
{
    /**
     * @param string $username
     * @param string $password
     */
    public function createUser(
        $username,
        $password
    ) {
    }

    /**
     * @param string $chatRoomName
     * @param string $ownerName
     */
    public function createChatRoom(
        $chatRoomName,
        $ownerName
    ) {
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
    }

    /**
     * @param string $username Openfire username for the user
     *
     * @return string
     */
    public function getUserJID($username)
    {
        return $username.'@localhost';
    }
}
