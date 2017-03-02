<?php
/**
 * Created by PhpStorm.
 * User: Parikshit
 * Date: 3/2/2017
 * Time: 4:53 PM
 */

namespace Core\Lib;

/**
 * Class Todos
 * @package Core\Lib
 * @Table(name="users")
 * @Entity()
 */
class Users
{
    /**
     * @Column(name="id", type="integer", length=11)
     * @Id
     */
    private $id;
    /**
     * @Column(name="username", type="string", length=255, nullable=false)
     *
     */
    private $username;
    /**
     * @Column(name="password", type="string", length=255, nullable=false)
     *
     */
    private $password;
    
    public function __construct()
    {
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Users
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
