<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IksGKomponen;
use App\Models\MasterIksGroupKomponenDetail;
use Yajra\DataTables\Facades\DataTables;

class MasterIksGroupKomponenController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Master IKS Group Komponen';
        $table_id = 'm_iks_gkomponen';
        return view('iksgkomponen/crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = IksGKomponen::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "<a title='Info Data' href='/iksgkdetail/".$data->id."' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-info' ></i></a>";
                    $aksi .= "<a title='Edit Data' href='/gkomponen/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->group}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(IksGKomponen::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS Group Komponen';
        return view('iksgkomponen/create',compact('subtitle','icon'));
    }

    public function edit(Request $request){
        $data = IksGKomponen::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS Group Komponen';
        return view('iksgkomponen/edit',compact('subtitle','icon','data'));
    }

    public function store(Request $request)
    {
          $request->validate([
              'group' => 'required',
          ],[
              'group.required' => 'Group Komponen Wajib Diisi',
          ]);

        IksGKomponen::create([
            'id' => IksGKomponen::max('id')+1,
            'group' => $request->group
        ]);
        return redirect('gkomponen')->with('message', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
         $request->validate([
             'group' => 'required',
         ],[
             'group.required' => 'Group Komponen Wajib Diisi',

         ]);
        $iksgkomponen = IksGKomponen::find($id);
        $iksgkomponen->update($request->all());
        return redirect('gkomponen')->with('message', 'Data Berhasil Diedit');
    }
}
