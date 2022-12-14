<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CrudController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Mahasiswa';
        $table_id = 'tbmahasiswa';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = Mahasiswa::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nim}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nim}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(Mahasiswa::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Mahasiswa';
        return view('create',compact('subtitle','icon'));
    }

    public function edit(Request $request){
        $data = Mahasiswa::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Mahasiswa';
        return view('edit',compact('subtitle','icon','data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required'
        ],[
            'nim.required' => 'NIM Wajib Diisi!',
            'nim.numeric' => 'NIM Hanya Boleh Angka',
            'nama.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi'
        ]);
        Mahasiswa::create($request->all());
        return redirect('crud')->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required'
        ],[
            'nim.required' => 'NIM Wajib Diisi!',
            'nim.numeric' => 'NIM Hanya Boleh Angka',
            'nama.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi'
        ]);
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->update($request->all());
        return redirect('crud')->with('massage', 'Data Berhasil Diedit');
    }
}
