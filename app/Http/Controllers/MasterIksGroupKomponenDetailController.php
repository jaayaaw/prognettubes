<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterIksGroupKomponenDetail;
use App\Models\IksGKomponen;
use Yajra\DataTables\Facades\DataTables;

class MasterIksGroupKomponenDetailController extends Controller
{
    public function index($id){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Master IKS Group Komponen Detail';
        $table_id = 'm_iks_gkomponen_detail';
        return view('masteriksgkomponendetail/crud',compact('subtitle','table_id','icon','id'));
    }

    public function listData(Request $request){
        $data = MasterIksGroupKomponenDetail::with('gkdetailSel')->where('gkomponen_id',$request->id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/iksgkdetail/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
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

    public function create($id){
        // $iksgkomponen = MasterIksGroupKomponenDetail::with(['gkdetailSel'])->get()->first();
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Group Komponen Detail';
        return view('masteriksgkomponendetail/create',compact('subtitle','icon','id'));
    }

    public function edit(Request $request, $id){
        $iksgkomponen = IksGKomponen::all();
        $data = MasterIksGroupKomponenDetail::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Group Komponen Detail';
        return view('masteriksgkomponendetail/edit',compact('subtitle','icon','data','iksgkomponen','id'));
    }

    public function store(Request $request)
    {
         $request->validate([
             'gkomponen_detail' => 'required',
         ],[
             'gkomponen_detail.required' => 'Group Komponen Detail Wajib Diisi',
         ]);
        MasterIksGroupKomponenDetail::create($request->all());
        return redirect()->route('iksgkdetail.list', [$request->gkomponen_id])->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gkomponen_detail' => 'required',
        ],[
            'gkomponen_detail.required' => 'Group Komponen Detail Wajib Diisi',

        ]);
        $iksgkomponendetail = MasterIksGroupKomponenDetail::find($id);
        $iksgkomponendetail->update($request->all());
        return redirect()->route('iksgkdetail.list', [$request->gkomponen_id])->with('massage', 'Data Berhasil Diedit');
    }
}

