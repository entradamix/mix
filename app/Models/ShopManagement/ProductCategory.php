<?php

namespace App\Models\ShopManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
  use HasFactory;
  protected $fillable = [
    'organizer_id',
    'name',
    'slug',
    'language_id',
    'image',
    'status',
    'is_feature',
  ];
  
   //Organizer
  public function organizer()
  {
    return $this->hasOne(Organizer::class);
  }
}
