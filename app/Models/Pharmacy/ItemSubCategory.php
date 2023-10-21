<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;

class ItemSubCategory extends Model implements ActiveStatus
{
    use HasFactory;

    protected $fillable = ['sub_category_name','category_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemSubCategory
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
}
