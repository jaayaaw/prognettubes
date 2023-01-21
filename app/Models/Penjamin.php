<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjamin extends Model
{
    use HasFactory;
    protected $table="m_penjamin";
    protected $fillable=['kode','nama','prefix_antrean'];
}
