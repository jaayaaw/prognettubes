<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIks extends Model
{
    use HasFactory;
    protected $table='m_iks';

    protected $fillable = ['kode','nama','penjamin_id','tipe_id','status_aktif'];
}
