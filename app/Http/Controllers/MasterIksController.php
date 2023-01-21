<?php

namespace App\Http\Controllers;

use App\Models\MasterIks;
use App\Models\Penjamin;
use App\Models\IksTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterIksController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Master Data IKS';
        $table_id = 'm_iks';
        return view('masteriks/master',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = MasterIks::with(['penjaminSel','tipeSel'])->get();
        \Log::info($data);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Riwayat Transaksi' href='/provideriks/".$data->id."/".$data->nama."' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-harddrives' ></i></a>";
                    $aksi .= "<a title='Edit Data' href='/masteriks/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(MasterIks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $penjamin = Penjamin::all();
        $tipeiks = IksTipe::all();
        $iks = Penjamin::where('nama','IKS')->first();
        $findmaxiks = -1;
        $getData = MasterIks::all();
        foreach($getData as $gd)
        {
            if($gd->kode > $findmaxiks)
            {
                $findmaxiks = $gd->kode;
            }
        }
        $findmaxiks++;
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS';
        return view('masteriks/create',compact('iks','subtitle','icon','findmaxiks','penjamin','tipeiks'));
    }

    public function edit(Request $request){
        $penjamin = Penjamin::all();
        $tipeiks = IksTipe::all();
        $data = MasterIks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS';
        return view('masteriks/edit',compact('subtitle','icon','data','penjamin','tipeiks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe_id' => 'required',
            'penjamin_id' => 'required',
            'status_aktif' => 'required'
        ],[
            'nama.required' => 'Kolom Nama Tidak Boleh Kosong!',
            'tipe_id.required' => 'Kolom Tipe ID Tidak Boleh Kosong!',
            'penjamin_id.required' => 'Kolom Penjamin Tidak Boleh Kosong!',
            'status_aktif.required' => 'Kolom Status Aktif Tidak Boleh Kosong!'
        ]);
        MasterIks::create($request->all());
        return redirect('masteriks')->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'tipe_id' => 'required',
            'status_aktif' => 'required'
        ],[
            'kode.required' => 'Kolom Kode Tidak Boleh Kosong!',
            'nama.required' => 'Kolom Nama Tidak Boleh Kosong!',
            'tipe_id.required' => 'Kolom Tipe ID Tidak Boleh Kosong!',
            'status_aktif.required' => 'Kolom Status Aktif Tidak Boleh Kosong!'
        ]);
        $iks = MasterIks::find($id);
        $iks->update($request->all());
        return redirect('masteriks')->with('massage', 'Data Berhasil Diedit');
    }
}
