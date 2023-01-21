<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIksGroupKomponenDetail extends Model
{
    use HasFactory;
    protected $table='m_iks_gkomponen_detail';
    protected $fillable=['gkomponen_id','gkomponen_detail'];
    public $timestamps = false;

    public function gkdetailSel()
    {
        return $this->belongsTo(IksGKomponen::class,'gkomponen_id','id');
    }

}
