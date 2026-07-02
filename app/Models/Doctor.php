<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use Notifiable;

    protected $fillable = ['username', 'password', 'name'];
    protected $hidden   = ['password'];
}
