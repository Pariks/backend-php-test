<?php

namespace Core\Lib;

/**
 * Class Todos
 * @package Core\Lib
 * @Table(name="todos")
 * @Entity()
 */
class Todos
{

    /**
     * @Column(name="id", type="integer", length=11) @Id @GeneratedValue
     *  
     */
    private $id;


    /**
     * @Column(name="user_id", type="integer", length=11)
     * @OneToMany(targetEntity="Users", mappedBy="id", cascade={"ALL"}, indexBy="user_id")
     */
    private $user_id;

    /**
     * @Column(name="description", type="string", length=255, nullable=true)
     *
     */
    private $description;

    /**
     * @Column(name="completed", type="integer", length=2, nullable=true)
     *
     */
    private $completed;

    public function __construct()
    {
    }


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Todos
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Todos
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Todos
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set completed
     *
     * @param integer $completed
     *
     * @return Todos
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return integer
     */
    public function getCompleted()
    {
        return $this->completed;
    }
}
