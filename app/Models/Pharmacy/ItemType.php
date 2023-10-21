<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
