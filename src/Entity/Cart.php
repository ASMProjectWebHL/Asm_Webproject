<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $cartpro = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $cartuser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCartpro(): ?Product
    {
        return $this->cartpro;
    }

    public function setCartpro(?Product $cartpro): self
    {
        $this->cartpro = $cartpro;

        return $this;
    }

    public function getCartuser(): ?User
    {
        return $this->cartuser;
    }

    public function setCartuser(?User $cartuser): self
    {
        $this->cartuser = $cartuser;

        return $this;
    }


}
