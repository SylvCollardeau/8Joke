<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_post", type="integer")
     */
    private $idPost;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="type_vote", type="string")
     */
    private $typeVote;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPost
     *
     * @param integer $idPost
     *
     * @return Vote
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get idPost
     *
     * @return int
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Vote
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setTypeVote($typeVote)
    {
        $this->typeVote = $typeVote;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getTypeVote()
    {
        return $this->idTypeVote;
    }
}

