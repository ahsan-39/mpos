<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;

class ItemUnitOfMeasure extends Model implements ActiveStatus
{
    use HasFactory;

    
    protected $fillable = ['uom_name','category_group_id','child_uom_id','child_uom_value','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemUnitOfMeasure
    {
        $this->update([
            'is_active' => $active
        ]);
        return $this;
    }

    public function categoryGroup()
    {
        return $this->belongsTo(ItemCategoryGroup::class,'category_group_id','id');
    }
}
