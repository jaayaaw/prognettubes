<?php

namespace App\Http\Controllers;

use App\Models\KomponenIksDetail;

use App\Models\KomponenIks;
use App\Models\ProviderIks;
use App\Models\Pegawai;
use App\Models\JenisProfesi;
use App\Models\IksGKomponen;
use App\Models\MasterIksGroupKomponenDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiKomponenIksDetailController extends Controller
{
    public function index($id, $nama){
        $komponenDetail = KomponenIksDetail::with('tkomponenSel.gkomponenSel')->get();
        

        $iksp = KomponenIksDetail::with('tkomponenSel.providerSel.iksIdSel')->get();
        $ikspid = KomponenIks::where('id', $id)->pluck('iks_provider_id')->first();
        $provider = ProviderIks::where('id', $ikspid)->pluck('iks_id')->first();
        $icon = 'ni ni-dashlite';
        $subtitle = 'Komponen IKS Detail';
        $table_id = 't_komponen_iks_d';
        return view('tkomponeniksdetail/t-iksdetailList',compact('subtitle','table_id','icon','id','nama','provider'));
    }

    public function listData(Request $request){
        $tkomponen = KomponenIks::where('id', $request->id)->pluck('iks_gkomponen_id')->first();
        $idgroup = KomponenIks::where('iks_gkomponen_id', $tkomponen)->pluck('group')->first();
        $group = IksGKomponen::where('group', $idgroup)->pluck('id')->first();
        $detail = MasterIksGroupKomponenDetail::with('gkdetailSel')->where('gkomponen_id', $group)->get();
        \Log::info($detail);

        // $data = KomponenIksDetail::with(['tkomponenSel','pegawaiSel'])->where('komponen_iks_id',$request->id)->get();
        $datatables = DataTables::of($detail);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data) use($request){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/komponeniksdetail/".$data->id."/".$request->nama."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$request->gkomponen_detail}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->gkomponen_detail}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(MasterIksGroupKomponenDetail::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    
    }

    public function create($id, $nama){
        // $detail = MasterIksGroupKomponenDetail::where('id',$id)->first();
        $komponen = KomponenIks::where('id', $id)->pluck('group')->first();
        $group = IksGKomponen::where('group', $komponen)->pluck('id')->first();
        $detail = MasterIksGroupKomponenDetail::with('gkdetailSel')->where('gkomponen_id', $group)->first();

        $pegawai = Pegawai::all();
        $gawai = Pegawai::where('nama','andi')->first();
        $profesi = JenisProfesi::all();
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Komponen IKS Detail';
        return view('tkomponeniksdetail/t-iksdetailCreate',compact('subtitle','icon','id','nama','pegawai','profesi','gawai','komponen','detail'));
    }

    public function store(Request $request, $id, $nama){

        $request->validate([
            'gkomponen_detail' => 'required',
        ],[
            'gkomponen_detail.required' => 'Kolom Komponen IKS Detail Tidak Boleh Kosong!',
        ]);

        // $pegawaiId;
        // $profesiId;

        // // $getGroupId = KomponenIks::where('id', $request->komponen_iks_id)->pluck('id')->first();
        // // if ($getGroupId == $request->komponen_iks_id ){
        // //     $pegawaiId = $request->pegawai_id;
        // //     $profesiId = $request->jenis_profesi_id;
        // // }else{
        // //     $pegawaiId = 464;
        // //     $profesiId = 1;
        // // }

        MasterIksGroupKomponenDetail::create([
            'gkomponen_id' => $request->gkomponen_id,
            'gkomponen_detail' => $request->gkomponen_detail
        ]);
        return redirect()->route('komponeniksdetail.list', [$id, $nama])->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function edit(Request $request, $id, $nama){


        $data = MasterIksGroupKomponenDetail::find($request->id);

        $detail = MasterIksGroupKomponenDetail::with('gkdetailSel')->where('id', $request->id)->pluck('gkomponen_id')->first();
        $group = IksGKomponen::where('id', $detail)->pluck('group')->first();
        $komponen = KomponenIks::where('group', $group)->pluck('id')->first();
        dd($komponen);

        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Komponen IKS Detail';
        return view('tkomponeniksdetail/t-iksdetailEdit',compact('subtitle','icon','data','id','nama','komponenid'));
    }

    public function update(Request $request, $id, $nama){

        $request->validate([
            'gkomponen_id' => 'required',
            'gkomponen_detail' => 'required',
        ],[
            'gkomponen_id.required' => 'Kolom Komponen IKS ID Tidak Boleh Kosong!',
            'gkomponen_detail.required' => 'Kolom Komponen IKS Detail Tidak Boleh Kosong!',
        ]);
        
        $tubes = MasterIksGroupKomponenDetail::find($id);
        $tubes->update($request->all());
        return redirect()->route('komponeniksdetail.list', [$getGroupId, $nama])->with('massage', 'Berhasil Mengedit Data'); 
    }
}
