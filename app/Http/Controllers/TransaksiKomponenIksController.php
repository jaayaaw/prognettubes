<?php

namespace App\Http\Controllers;

use App\Models\KomponenIks;
use App\Models\ProviderIks;
use App\Models\IksGKomponen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiKomponenIksController extends Controller
{
    public function index($id,$nama){
        $iksp = KomponenIks::with('providerSel.iksIdSel')->get();
        \Log::info($iksp);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Komponen IKS';
        $table_id = 't_komponen_iks';
        return view('tkomponeniks/list',compact('subtitle','table_id','icon','id','iksp','nama'));
    }

    public function listData(Request $request){
        $data = KomponenIks::with(['providerSel.iksIdSel','gkomponenSel'])->where('iks_provider_id',$request->id)->get();
        \Log::info($data);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Detail IKS Komponen' href='/komponeniksdetail/".$data->id."/".$data->providerSel->iksIdSel->nama."' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-list' ></i></a>";
                    $aksi .= "<a title='Edit Data' href='/tkomponeniks/".$data->id."/".$data->providerSel->iksIdSel->nama."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->group}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(KomponenIks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id, $nama){
        // $iks = Penjamin::where('nama','IKS')->first();
        // $findmaxiks = MasterIks::max('id')+1;
        $iksprovider = ProviderIks::all();
        $komponenid = IksGKomponen::all();
        // $tkomponengroup = KomponenIks::all();
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS';
        return view('tkomponenIks/createtkomponen',compact('subtitle','icon','iksprovider','komponenid','id','nama'));
    }

    public function edit(Request $request, $id, $nama){
        $iksprovider = ProviderIks::all();
        $komponenid = IksGKomponen::all();
        $data = KomponenIks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS';
        return view('tkomponenIks/edittkomponen',compact('subtitle','icon','data','id','komponenid','nama','iksprovider'));
    }

    public function store(Request $request, $nama)
    {
        $request->validate([
            'iks_provider_id' => 'required',
            'iks_gkomponen_id' => 'required',
        ],[
            'iks_provider_id.required' => 'Kolom IKS Provider ID Tidak Boleh Kosong!',
            'iks_gkomponen_id.required' => 'Kolom IKS Group Komponen ID Tidak Boleh Kosong!',
        ]);

        $getName = IksGKomponen::where('id', $request->iks_gkomponen_id)->pluck('group')->first();

        KomponenIks::create([
            'id' => KomponenIks::max('id')+1,
            'iks_provider_id' => $request->iks_provider_id,
            'iks_gkomponen_id' => $request->iks_gkomponen_id,
            'group' => $getName
        ]);
        return redirect()->route('tkomponeniks.list', [$request->iks_provider_id, $nama])->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id, $nama)
    {
        $request->validate([
            'iks_provider_id' => 'required',
            'iks_gkomponen_id' => 'required'
        ],[
            'iks_provider_id.required' => 'Kolom IKS Provider ID Tidak Boleh Kosong!',
            'iks_gkomponen_id.required' => 'Kolom IKS Group Komponen ID Tidak Boleh Kosong!'
        ]);

        $getName = IksGKomponen::where('id', $request->iks_gkomponen_id)->pluck('group')->first();

        $iks = KomponenIks::find($id);
        $iks->update([
            'iks_provider_id' => $request->iks_provider_id,
            'iks_gkomponen_id' => $request->iks_gkomponen_id,
            'group' => $getName
        ]);
        return redirect()->route('tkomponeniks.list', [$request->iks_provider_id, $nama])->with('massage', 'Data Berhasil Diedit');
    }
}
