<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ActiveStatus;

class ItemDosageForm extends Model implements ActiveStatus
{
    use HasFactory;

     
    protected $fillable = ['dosage_form_name','dosage_form_type_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function markActive($active=true): ItemDosageForm
    {
        $this->update([
            'is_active' => $active
        ]);
        return $this;
    }

    public function dosageFormType()
    {
        return $this->belongsTo(ItemDosageFormType::class,'dosage_form_type_id','id');
    }
}
