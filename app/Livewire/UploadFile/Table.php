<?php

namespace App\Livewire\UploadFile;

use App\Jobs\CheckRedisQueue;
use App\Models\UploadFile;
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
}
