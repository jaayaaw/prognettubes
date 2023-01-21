<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IksGKomponen extends Model
{
    use HasFactory;

    protected $table='m_iks_gkomponen';

    protected $fillable = ['id','group'];
    public $timestamps = false;
}
