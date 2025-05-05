<?php

namespace App\Livewire\UploadFile;

use App\Jobs\CheckRedisQueue;
use App\Models\UploadFile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Table extends Component
{
    public $uploadedFile;

    protected function transformUploadedFile($file)
    {
        return [
            'id' => $file->id,
            'time' =>  $file->timeDiff(),
            'file_name' => $file->file_name,
            'status' => $file->status,
        ];
    }

    public function mount()
    {
        $this->refreshUploadedFile();
    }

    public function render()
    {
        return view('livewire.upload-file.table');
    }

    public function refreshUploadedFile()
    {
        $files = UploadFile::all();
        $this->uploadedFile = $files->map(function ($file) {
            return $this->transformUploadedFile($file);
        });
    }

    public function deleteUploadedFile($id)
    {
        $uploadedFile = UploadFile::find($id);

        try {
            DB::beginTransaction();

            if($uploadedFile) {
                unlink(storage_path('app/public/' . $uploadedFile->file_path));
                $uploadedFile->delete();

                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

    }
}
