<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Row;
use App\Models\UploadFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

// use OnEachRow to validate, skip row, update or create
// use ToModel if no custom logic involved
// class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading
class ProductsImport implements OnEachRow, WithHeadingRow, WithChunkReading, ShouldQueue
{
    protected $uploadedFile;

    public function __construct(UploadFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    private function checkExist($row, $key)
    {
        if(array_key_exists($key, $row)) {
            return true;
        }

        return false;
    }

    private function cleanNonUTF8Char($value)
    {
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

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
            $productData[$attribute] = $this->checkExist($row, $key)
                ? $this->cleanNonUTF8Char($row[$key])
                : null;
        }

        if (empty($productData['uuid'])) {
            return;
        }

        $productData['upload_file_id'] = $this->uploadedFile->id ?? null;

        Product::updateOrCreate(
            ['uuid' => $productData['uuid']],
            $productData
        );
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
