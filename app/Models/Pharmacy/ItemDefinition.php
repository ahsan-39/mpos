<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;


class ItemDefinition extends Model implements ActiveStatus
{
    use HasFactory;

    protected $fillable = ['is_expiry','generic_id','item_type_id','size_specification_id',
    'dosage_form_id','dosage_route_id','uom_id','strength_id','pack_size','unit_pack_size','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemDefinition
    {
        $this->update([
            'is_active' => $active
        ]);
        return $this;
    }
    
}
