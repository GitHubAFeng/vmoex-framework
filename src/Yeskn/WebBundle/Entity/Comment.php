<?php

/*
 * This file is part of project yeskn/vmoex.
 *
 * (c) Jaggle <jaggle@yeskn.com>
 *
 * created at 2018-05-25 22:28:22
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yeskn\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Yeskn\WebBundle\Repository\CommentRepository")
 */
class Comment
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
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=800)
     */
    private $content;

    /**
     * @var integer
     * @ORM\ManyToMany(targetEntity="Yeskn\WebBundle\Entity\User", inversedBy="thumbUpComments")
     * @ORM\JoinTable(name="user_thumbup_comment")
     */
    private $thumbUpUsers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var User
     *
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Yeskn\WebBundle\Entity\User",inversedBy="comments")
     */
    private $user;

    /**
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Yeskn\WebBundle\Entity\Post", inversedBy="comments")
     */
    private $post;

    /**
     * @ORM\Column(name="reply_to", type="integer")
     * @ORM\OneToOne(targetEntity="Yeskn\WebBundle\Entity\Comment")
     */
    private $replyTo;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function isDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param bool $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param mixed $replyTo
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }



    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->thumbUpUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add thumbUpUser
     *
     * @param \Yeskn\WebBundle\Entity\User $thumbUpUser
     *
     * @return Comment
     */
    public function addThumbUpUser(\Yeskn\WebBundle\Entity\User $thumbUpUser)
    {
        $this->thumbUpUsers[] = $thumbUpUser;

        return $this;
    }

    /**
     * Remove thumbUpUser
     *
     * @param \Yeskn\WebBundle\Entity\User $thumbUpUser
     */
    public function removeThumbUpUser(\Yeskn\WebBundle\Entity\User $thumbUpUser)
    {
        $this->thumbUpUsers->removeElement($thumbUpUser);
    }

    /**
     * Get thumbUpUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThumbUpUsers()
    {
        return $this->thumbUpUsers;
    }
}
