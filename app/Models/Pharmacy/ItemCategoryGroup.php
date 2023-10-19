<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoryGroup extends Model
{
    use HasFactory;
    
    protected $fillable = ['category_group_name','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
