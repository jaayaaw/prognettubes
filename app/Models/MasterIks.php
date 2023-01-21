<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIks extends Model
{
    use HasFactory;
    protected $table='m_iks';

    protected $fillable = ['kode','nama','penjamin_id','tipe_id','status_aktif'];

    public function penjaminSel()
    {
        return $this->belongsTo(Penjamin::class,'penjamin_id','id');
    }

    public function tipeSel()
    {
        return $this->belongsTo(IksTipe::class,'tipe_id','id');
    }
}
