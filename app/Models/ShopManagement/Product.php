<?php

namespace App\Models\ShopManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;
  protected $fillable = [
    'organizer_id',
    'stock',
    'sku',
    'feature_image',
    'current_price',
    'previous_price',
    'is_feature',
    'status',
    'type',
    'file_type',
    'download_file',
    'download_link'
  ];
  
  //Organizer
  public function organizer()
  {
    return $this->hasOne(Organizer::class);
  }

  //order_items
  public function order_items()
  {
    return $this->hasMany(OrderItem::class);
  }
  
  //product_reviews
  public function product_reviews()
  {
    return $this->hasMany(ProductReview::class);
  }
}
