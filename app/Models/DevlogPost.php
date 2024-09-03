<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DevlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'content', 'published_at', 'series_id'];

    protected function casts()
    {
        return [
            'published_at' => 'datetime',
            'series_id' => 'integer',
        ];
    }

    public function series()
    {
        return $this->belongsTo(DevlogSeries::class);
    }
}
