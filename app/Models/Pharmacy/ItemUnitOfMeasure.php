<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnitOfMeasure extends Model
{
    use HasFactory;

    
    protected $fillable = ['uom_code','uom_name','category_group_id','child_uom_id','child_uom_value','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
