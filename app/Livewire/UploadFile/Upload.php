<?php

namespace App\Livewire\UploadFile;

use App\Enums\FileStatus;
use App\Imports\ProductsImport;
use App\Jobs\ImportProductsJob;
use App\Models\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Component
{
    use WithFileUploads;

    public $uploadedFile;

    protected $rules = [
        'uploadedFile' => 'required|file|mimes:csv,xlsx|max:51200',
    ];

    public function render()
    {
        return view('livewire.upload-file.upload');
    }

    public function uploadFile()
    {
        $this->validate();

        $path = $this->uploadedFile->store('uploads', 'public');

        try {
            DB::beginTransaction();

            $uploadFile = UploadFile::create([
                'file_name' => $this->uploadedFile->getClientOriginalName(),
                'status' => FileStatus::PENDING->value,
                'file_path' => $path,
            ]);

            //send storage path to the job
            ImportProductsJob::dispatch(storage_path('app/public/' . $path), $uploadFile);
            // unlink(storage_path('app/public/' . $path));

            DB::commit();

            $this->uploadedFile = null;

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Upload/import failed: ' . $e->getMessage());

            if (!isset($uploadFile)) {
                UploadFile::create([
                    'file_name' => $this->uploadedFile->getClientOriginalName(),
                    'status' => FileStatus::FAILED->value,
                    'file_path' => $path,
                ]);
            } else {
                $uploadFile->update(['status' => FileStatus::FAILED->value]);
            }
        }
    }
}
