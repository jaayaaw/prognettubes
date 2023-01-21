<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenIksDetail extends Model
{
    use HasFactory;
    protected $table='t_komponen_iks_d';

    protected $fillable=['komponen_iks_id','pegawai_id','jenis_profesi_id','komponen_iks_detail'];
    public $timestamps = false;

    public function tkomponenSel()
    {
        return $this->belongsTo(KomponenIks::class,'komponen_iks_id','id');
    }

    public function pegawaiSel()
    {
        return $this->belongsTo(Pegawai::class,'pegawai_id','id');
    }

    public function jenisProfesiSel()
    {
        return $this->belongsTo(JenisProfesi::class,'jenis_profesi_id','id');
    }

}
