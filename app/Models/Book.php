<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['crawl_code' , 'digikala_id' , 'title' , 'brand' , 'image' , 'seller_id' , 'seller_name' , 'seller_url' , 'rate' , 'selling_price', 'rrp_price' , 'order_limit' , 'discount_percent'];
}
