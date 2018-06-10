<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
    const STATUS_NEW = 'new';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_CANCEL = 'cancel';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clientName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientPhone;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $status = self::STATUS_NEW;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flowers", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flower;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string")
     */
    private $comment;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getFlower()
    {
        return $this->flower;
    }

    /**
     * @param mixed $flower
     */
    public function setFlower($flower)
    {
        $this->flower = $flower;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(?string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientPhone(): ?string
    {
        return $this->clientPhone;
    }

    public function setClientPhone(string $clientPhone): self
    {
        $this->clientPhone = $clientPhone;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }
}
