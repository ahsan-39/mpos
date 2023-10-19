<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','category_group_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
    
}
