<?php

namespace App\Http\Controllers;

use App\Models\MasterIks;
use App\Models\Penjamin;
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
        $data = MasterIks::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
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
        $iks = Penjamin::where('nama','IKS')->first();
        $findmaxiks = MasterIks::max('id')+1;
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS';
        return view('masteriks/create',compact('iks','subtitle','icon','findmaxiks'));
    }

    public function edit(Request $request){
        $data = MasterIks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS';
        return view('masteriks/edit',compact('subtitle','icon','data'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nim' => 'required|numeric',
        //     'nama' => 'required',
        //     'alamat' => 'required'
        // ],[
        //     'nim.required' => 'NIM Wajib Diisi!',
        //     'nim.numeric' => 'NIM Hanya Boleh Angka',
        //     'nama.required' => 'Nama Wajib Diisi',
        //     'alamat.required' => 'Alamat Wajib Diisi'
        // ]);
        MasterIks::create($request->all());
        return redirect('masteriks')->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nim' => 'required|numeric',
        //     'nama' => 'required',
        //     'alamat' => 'required'
        // ],[
        //     'nim.required' => 'NIM Wajib Diisi!',
        //     'nim.numeric' => 'NIM Hanya Boleh Angka',
        //     'nama.required' => 'Nama Wajib Diisi',
        //     'alamat.required' => 'Alamat Wajib Diisi'
        // ]);
        $iks = MasterIks::find($id);
        $iks->update($request->all());
        return redirect('masteriks')->with('massage', 'Data Berhasil Diedit');
    }
}
