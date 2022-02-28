<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','document_type_id','payment_date','amount_paid'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
