<?php

namespace App\Jobs;

use App\Enums\FileStatus;
use App\Imports\ProductsImport;
use App\Models\UploadFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filePath;
    public $uploadFile;

    /**
     * Job received the path after upload
     *
     * @param  string  $filePath
     * @return void
     */
    public function __construct($filePath, $uploadFile)
    {
        $this->filePath = $filePath;
        $this->uploadFile = $uploadFile;
    }

    public function handle()
    {
        $uploadedFile = UploadFile::find($this->uploadFile->id);

        try {
            $uploadedFile?->update([
                'status' => FileStatus::PROCESSING->value,
            ]);

            // Excel::import(new ProductsImport($uploadedFile), $this->filePath);
            // using queue, so use queueimport
            Excel::queueImport(new ProductsImport($uploadedFile), $this->filePath);

        } catch (\Throwable $th) {
            Log::error('Import failed: ' . $th->getMessage(), ['exception' => $th]);

            $uploadedFile?->update([
                'status' => FileStatus::FAILED->value,
            ]);
        }
    }
}
