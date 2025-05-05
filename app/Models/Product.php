<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'style_no',
        'mainframe_color',
        'size',
        'color',
        'price_per_piece',
        'upload_file_id',
    ];

    public function uploadFile()
    {
        return $this->belongsTo(UploadFile::class, 'upload_file_id');
    }
}
