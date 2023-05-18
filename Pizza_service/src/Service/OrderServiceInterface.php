<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\OrderData;

interface OrderServiceInterface
{
  public function saveOrder(string $orderProducts, int $orderCost, int $orderClient, string $orderTime, string $orderAddress): int;
  public function getOrder(int $orderId): OrderData;
  public function deleteOrder(int $orderId): void;
  public function listOrders(): array;
}