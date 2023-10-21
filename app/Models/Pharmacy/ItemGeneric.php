<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;
use App\Models\Pharmacy\ItemCategory;
use App\Models\Pharmacy\ItemSubCategory;

class ItemGeneric extends Model implements ActiveStatus
{
    use HasFactory;

     
    protected $fillable = ['generic_name','category_id','sub_category_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemGeneric
    {
        $this->update([
            'is_active' => $active
        ]);
        return $this;
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class,'category_id','id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ItemSubCategory::class,'sub_category_id','id');
    }
}
