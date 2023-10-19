<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGeneric extends Model
{
    use HasFactory;

     
    protected $fillable = ['generic_name','category_id','sub_category_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
