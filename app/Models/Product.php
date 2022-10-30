<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_descripton',
        'product_shortdes',
        'regular_price',
        'sale_price',
        'product_sku',
        'product_quantity',
        'product_stock',
        'productCategory',
        'productBrand',
        'future_image',
        'product_gallery_imgOne',
        'product_gallery_imgTwo',
        'product_gallery_imgThree',
        'product_gallery_imgFour',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'product_category');
    }

}
