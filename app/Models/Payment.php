<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['payment_id', 'payer_id', 'payer_email', 'amount', 'curreny', 'payment_status'];
}
