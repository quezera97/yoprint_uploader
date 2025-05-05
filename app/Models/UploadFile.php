<?php

namespace App\Models;

use App\Traits\TrackActionWithoutSoftDelete;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory, TrackActionWithoutSoftDelete;

    protected $fillable = [
        'file_name',
        'status',
        'file_path',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function timeDiff()
    {
        $formatTime = $this->created_at->format('d/m/Y h:i A');
        $diffTime = Carbon::parse($this->created_at)->diffForHumans();
        return $formatTime . ' ( ' . $diffTime . ' )';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'upload_file_id');
    }
}
