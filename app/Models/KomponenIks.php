<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenIks extends Model
{
    use HasFactory;
    protected $table='t_komponen_iks';

    protected $fillable = ['id','iks_provider_id','iks_gkomponen_id','group'];
    public $timestamps = false;

    public function providerSel()
    {
        return $this->belongsTo(ProviderIks::class,'iks_provider_id','id');
    }

    public function gkomponenSel()
    {
        return $this->belongsTo(IksGKomponen::class,'iks_gkomponen_id','id');
    }
}
