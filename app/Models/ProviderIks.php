<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderIks extends Model
{
    use HasFactory;
    protected $table='t_iks_provider';

    protected $fillable = ['id','iks_id','nomor_iks','nama_iks','tanggal_awal','tanggal_akhir','iks_file'];
    public $timestamps = false;

    public function iksIdSel()
    {
        return $this->belongsTo(MasterIks::class,'iks_id','id');
    }
}
