<?php

namespace App\Database;

use App\Model\Pizza;

class PizzaTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findPizzaList(): ?Pizza
    {
        $query = <<<SQL
            SELECT pizza_id, pizza_title, pizza_cost, pizza_description, pizza_structure, pizza_image
            FROM pizza
        SQL;

        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) { // do massive
            return $this->createPizzaFromRow($row);
        }

        return null;
    }

    public function getAllPizzas(): array
    {
        $pizzas = [];
        $query = <<<SQL
            SELECT pizza_id, pizza_title, pizza_cost, pizza_description, pizza_structure, pizza_image
            FROM pizza
        SQL;

        $statement = $this->connection->query($query);
        if ($rows = $statement->fetchAll(\PDO::FETCH_ASSOC)) {
            foreach ($rows as $row) {
                $pizza = $this->createPizzaFromRow($row);
                array_push($pizzas, $pizza);
            }
        }

        return $pizzas;
    }

    private function createPizzaFromRow(array $row): Pizza
    {
        return new Pizza(
            (int) $row["pizza_id"],
            $row["pizza_title"],
            $row["pizza_cost"],
            $row["pizza_description"],
            $row["pizza_structure"],
            $row["pizza_image"]
        );
    }
}