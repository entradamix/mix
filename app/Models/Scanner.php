<?php

namespace App\Models;

use App\Models\Event\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Scanner extends Model implements AuthenticatableContract
{
  use HasFactory, Authenticatable;
  protected $fillable = [
    'organizer_id',
    'photo',
    'cover',
    'email',
    'phone',
    'username',
    'password',
    'status',
    'amount',
    'facebook',
    'twitter',
    'linkedin',
    'email_verified_at',
  ];

  //withdraw
  public function organizer()
  {
    return $this->hasOne(Organizer::class);
  }

  //organizer info
  public function scanner_info()
  {
    return $this->hasOne(ScannerInfo::class);
  }
}
