<?php

require_once(dirname(dirname(__FILE__)) . '/model/UserModel.php');

/**
 * User Controller
 */
class UserController
{
    /**
     * Handles login
     */
    public function signup($params = array())
    {
        try {
            //brute force..hahaha!
            if ($params['password'] == $params['confirm_password']) {
                // $user = new UserModel();
                // $user->setPassword($params['password']);
                // $user->setUsername($params['username']);
                // $user->setFirstName('Floricel');
                // $user->setLastName('Colibao');
            }

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Handles login
     */
    public function login($params = array())
    {
        try {
           

            header('Location: http://missu-poll.local/templates/list.php');

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Checks user account
     */
    private function checkUserAccount()
    {
        
    }
}