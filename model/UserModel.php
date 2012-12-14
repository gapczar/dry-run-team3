<?php

require_once(dirname(__FILE__) . '/BaseModel.php');

/**
 * Represents user table
 */

class UserModel extends BaseModel {

    const TABLE_NAME = "users";

    const ID = 'users.id';

    const EMAIL_ADDRESS = 'users.email_address';

    const PASSWORD = 'users.password';

    const FIRST_NAME = 'users.first_name';

    const LAST_NAME = 'users.last_name';

    /**
     * abstract method
     * returns table name
     */
    protected function getTableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * abstract method
     * returns insert fields
     */
    protected function getInsertFields()
    {
        return array(self::ID, self::EMAIL_ADDRESS, self::PASSWORD, self::FIRST_NAME, self::LAST_NAME);
    }

    /**
     * Returns fields to update with corresponding data
     */
    protected function getFieldsToUpdate()
    {
        return self::ID.' = '.$this->getId().
                self::EMAIL_ADDRESS. ' = '.$this->getEmailAddress().
                self::PASSWORD. ' = '.$this->getPassword().
                self::FIRST_NAME. ' = '.$this->getFirstName().
                self::LAST_NAME. ' = '.$this->getLastName();
    }

    /**
     * Transforms row to objectModel
     *
     * @param array row, the row of resulset
     */
    protected function transformRowToObjectModel($row)
    {
        $user = new UserModel();

        $user->setId($row['0']);
        $user->setEmailAddress($row['1']);
        $user->setPassword($row['2']);
        $user->setFirstName($row['3']);
        $user->setLastName($row['4']);

        return user;
    }

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $emailAddress
     */
    private $emailAddress;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @param string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

     /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}
