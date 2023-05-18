<?php

namespace App\Service;

use App\Repository\OrderRepository;
use App\Entity\Order;
use App\Service\Data\OrderData;

class OrderService implements OrderServiceInterface
{
  private OrderRepository $orderRepository;

  public function __construct(OrderRepository $orderRepository)
  {
    $this->orderRepository = $orderRepository;
  }
  
  public function saveOrder(string $orderProducts, int $orderCost, int $orderClient, \DateTimeImmutable $orderTime, string $orderAddress): int
  {
    $order = new Order(
      null,
      $orderProducts,
      $orderCost,
      $orderClient,
      $orderTime,
      $orderAddress,
      null
    );
    return $this->orderRepository->store($order);
  }
  public function getOrder(int $orderId): OrderData
  {
    $order = $this->orderRepository->findById($orderId);
    if ($order === null) {
      throw $this->createNotFoundException();
    }

    return new OrderData(
      $order->getOrderId(),
      $order->getOrderProducts(),
      $order->getOrderCost(),
      $order->getOrderClient(),
      $order->getOrderTime(),
      $order->getOrderAddress(),
      $order->getOrderDelivered(),
    );
  }
  public function deleteOrder(int $orderId): void
  {
    $order = $this->orderRepository->findById($orderId);
    if ($order === null) {
      throw $this->createNotFoundException();
    }

    $this->orderRepository->delete($order);
  }
  public function listOrders(): array
  {
    $orders = $this->orderRepository->getListAll();

    $ordersView = [];
    foreach ($orders as $order) {
      $ordersView[] = new OrderData(
        $order->getOrderId(),
        $order->getOrderProducts(),
        $order->getOrderCost(),
        $order->getOrderClient(),
        $order->getOrderTime(),
        $order->getOrderAddress(),
        $order->getOrderDelivered(),
      );
    }

    return $ordersView;
  }
}