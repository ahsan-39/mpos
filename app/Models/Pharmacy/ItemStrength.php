<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;


class ItemStrength extends Model implements ActiveStatus
{
    use HasFactory;

    protected $fillable = ['strength_name','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemStrength
    {
        $this->update([
            'is_active' => $active
        ]);
        return $this;
    }
}
