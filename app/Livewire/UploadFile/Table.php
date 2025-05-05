<?php

namespace App\Livewire\UploadFile;

use App\Jobs\CheckRedisQueue;
use App\Models\UploadFile;
use Livewire\Component;

class Table extends Component
{
    public $count = 0;
    public $uploadedFile = [];

    public function mount()
    {
        CheckRedisQueue::dispatch();
        $this->uploadedFile = $this->refreshUploadedFile();
    }

    public function render()
    {
        return view('livewire.upload-file.table');
    }

    public function refreshUploadedFile()
    {
        $this->uploadedFile = UploadFile::get();
    }
}
