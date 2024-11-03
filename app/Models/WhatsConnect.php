<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class WhatsConnect extends Model
{

  use HasFactory, Authenticatable;

  protected $fillable = [
    'organizer_id',
    'uuid',
    'auth',
    'app',
    'webhook',
    'status'
  ];

  //organizer
  public function organizer()
  {
    return $this->belongsTo(Organizer::class);
  }
}
