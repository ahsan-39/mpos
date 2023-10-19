<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','phone','email','address','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
