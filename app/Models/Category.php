<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function category_files(): BelongsToMany
    {
        return $this->belongsToMany(CategoryFile::class);
    }

    public function scopeStatusActive()
    {
        return $this->where('status', 1);
    }
}
