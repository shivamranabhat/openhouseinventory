<?php 
namespace App\Imports;

use App\Models\Stock;
use App\Models\StockOut;
use App\Models\Department;
use App\Models\ItemIn;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StockOutImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip the header row
        $rows->shift();

        foreach ($rows as $row) {
            // Assuming the columns are in the order: Department, Item, Quantity
            $departmentName = $row[1];
            $productName = $row[2];
            $quantity = $row[3];

            // Find the department by name
            $department = Department::where('name', $departmentName)->first();

            $product = Product::where('name',$productName)->first();
            // Find the item_in_id by product id
            $itemIn = ItemIn::where('prouduct_id', $product->id)->first();
            if ($department && $itemIn) {
                
                $stockRecord = Stock::where('product_id', $product->id)->first();
               
                if($stockRecord->stock >= $quantity)
                {
                    // Create the StockOut record
                    StockOut::create([
                        'department_id' => $department->id,
                        'item_in_id' => $itemIn->id,
                        'company_id' => auth()->user()->company_id,
                        'quantity' => $quantity,
                        'slug' => \Str::slug($productName . '-' . now()),
                    ]);
                    $stockRecord->update([
                        'stock' => $stockRecord->stock - $quantity
                    ]); 
                }
            }
        }
    }
}
