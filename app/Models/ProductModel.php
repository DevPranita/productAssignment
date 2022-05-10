<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{	
	protected $table     = 'products';
    protected $fillable  = ['id','product_name','product_price','product_description' ,'product_image','created_at','updated_at'];
}
