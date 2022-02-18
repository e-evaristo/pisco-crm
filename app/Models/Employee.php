<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','birth_date','company_id','address','photo','phone','active'];

    protected $casts = [
        'active' => 'boolean',
        'birth_date' => 'date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
