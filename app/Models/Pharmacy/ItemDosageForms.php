<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDosageForms extends Model
{
    use HasFactory;

     
    protected $fillable = ['dosage_form_name','dosage_form_type_id','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
