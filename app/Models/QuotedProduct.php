<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotedProduct extends Model
{
    use HasFactory;
    protected $fillable = ['quote_id', 'vendor_id', 'product_id', 'price'];
}
