<?php
declare(strict_types=1);

namespace App\Service\Data;

class OrderData
{
  public function __construct(
    private ?int $orderId,
    private string $orderProducts,
    private int $orderCost,
    private int $orderClient,
    private string $orderTime, 
    private string $orderAddress, 
    private int $orderDelivered = 0)
  {
  }

  public function getOrderId(): ?int
  {
    return $this->orderId;
  }
  public function getOrderProducts(): string
  {
    return $this->orderProducts;
  }
  public function getOrderCost(): int
  {
    return $this->orderCost;
  }
  public function getOrderClient(): int
  {
    return $this->orderClient;
  }
  public function getOrderTime(): string
  {
    return $this->orderTime;
  }
  public function getOrderAddress(): string
  {
    return $this->orderAddress;
  }
  public function getOrderDelivered(): int
  {
    return $this->orderDelivered;
  }
}