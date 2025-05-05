<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading
{

    private function checkExist($row, $key)
    {
        if(array_key_exists($key, $row)) {
            return true;
        }

        return false;
    }

    /**
     * Map the rows of the CSV to your database model
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $keyPair = [
            'uuid' => 'unique_key',
            'title' => 'product_title',
            'description' => 'product_description',
            'style_no' => 'style',
            'mainframe_color' => 'sanmar_mainframe_color',
            'size' => 'size',
            'color' => 'color_name',
            'price_per_piece' => 'piece_price',
        ];
        $productData = [];

        foreach ($keyPair as $attribute => $key) {
            $productData[$attribute] = $this->checkExist($row, $key) ? $row[$key] : null;
        }

        return new Product($productData);
    }

    /**
     * Use chonky
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
