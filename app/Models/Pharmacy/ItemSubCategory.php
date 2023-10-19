<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_name','category_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
