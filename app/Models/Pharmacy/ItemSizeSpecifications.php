<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSizeSpecifications extends Model
{
    use HasFactory;

    protected $fillable = ['size_specification_code','size_specification_name','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
