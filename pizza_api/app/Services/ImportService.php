<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

use App\Models\Pizza\Pizza;
use App\Models\Pizza\PizzaType;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;

class ImportService
{
    public function import(UploadedFile $file, string $type)
    {
        // Ensure all lines are UTF-8 encoded to prevent malformed character errors from non-UTF-8 CSVs.

		// Read lines from file
		$lines = file($file->getRealPath());

		// Convert lines to UTF-8 if needed
		$utf8Lines = array_map(fn($line) => mb_convert_encoding($line, 'UTF-8', 'auto'), $lines);

		// Parse CSV
		$rows = array_map('str_getcsv', $utf8Lines);

		// Extract header
		$header = array_map('trim', array_shift($rows));

        $collection = [];

        foreach ($rows as $row) {
           	$collection[] = array_combine($header, $row);
        }

		match ($type) {
			'pizzatypes' => $this->importPizzaType($collection),
			'pizzas' => $this->importPizza($collection),
			'orders' => $this->importOrder($collection),
			'orderdetails' => $this->importOrderDetail($collection)
		};
    }

    private function importPizzaType(array $collection): void
	{
		$this->chunkedInsert(PizzaType::class, $collection);
	}

	private function importPizza(array $collection): void
	{
		$this->chunkedInsert(Pizza::class, $collection);
	}

	private function importOrder(array $collection): void
	{
		$this->chunkedInsert(Order::class, $collection);
	}

	private function importOrderDetail(array $collection): void
	{
		$this->chunkedInsert(OrderDetail::class, $collection);
	}

	private function chunkedInsert(string $modelClass, array $collection, int $chunkSize = 500): void
	{
		foreach (array_chunk($collection, $chunkSize) as $chunk) {
			$modelClass::insert($chunk);
		}
	}
	
}
