<?php

namespace App\Models\ShopManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCoupon extends Model
{
  use HasFactory;

  protected $fillable = [
    'organizer_id',
    'name',
    'code',
    'type',
    'value',
    'start_date',
    'end_date',
    'minimum_spend'
  ];
  
  //Organizer
  public function organizer()
  {
    return $this->hasOne(Organizer::class);
  }
}
