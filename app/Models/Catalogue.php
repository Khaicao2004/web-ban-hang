<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'image',
        'slug',
        'is_active',
        'description',
    ];
    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }
}
