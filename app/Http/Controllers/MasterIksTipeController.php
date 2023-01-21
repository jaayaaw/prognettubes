<?php

namespace App\Http\Controllers;

use App\Models\IksTipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterIksTipeController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Master Tipe IKS';
        $table_id = 'm_iks_tipe';
        return view('ikstipe/tipeList',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = IksTipe::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/ikstipe/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nim}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nim}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(IksTipe::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS Tipe';
        $findmaxkode = -1;
        $getData = IksTipe::all();
        foreach($getData as $gd)
        {
            if($gd->kode > $findmaxkode)
            {
                $findmaxkode = $gd->kode;
            }
        }
        $findmaxkode++;
        return view('ikstipe/tipeCreate',compact('subtitle','icon','findmaxkode'));
    }

    public function store(Request $request){
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'status_aktif' => 'required',
        ],[
            'kode.required' => 'Kode Wajib Diisi',
            'nama.required' => 'Nama Wajib Diisi',
            'status_aktif.required' => 'Status Aktif Wajib Diisi',

        ]);
        IksTipe::create ($request->all());
        return redirect('ikstipe')->with('massage', 'Berhasil Menambahkan Data Baru'); 
    }

    public function edit(Request $request){
        $data = IksTipe::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS Tipe';
        return view('iksTipe/tipeEdit',compact('subtitle','icon','data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'status_aktif' => 'required',
        ],[
            'kode.required' => 'Kode Wajib Diisi',
            'nama.required' => 'Nama Wajib Diisi',
            'status_aktif.required' => 'Status Aktif Wajib Diisi',

        ]);
        $tubes = IksTipe::find($id);
        $tubes->update($request->all());
        return redirect('ikstipe')->with('massage', 'Berhasil Mengedit Data'); 
    }
}
