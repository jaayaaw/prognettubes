<?php

namespace App\Http\Controllers;

use App\Models\Penjamin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterPenjaminController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Master Data Penjamin';
        $table_id = 'm_penjamin';
        return view('mpenjamin/p-master',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = Penjamin::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/penjamin/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(Penjamin::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Penjamin';
        $findmaxpenjamin = -1;
        $getData = Penjamin::all();
        foreach($getData as $gd)
        {
            if($gd->kode > $findmaxpenjamin)
            {
                $findmaxpenjamin = $gd->kode;
            }
        }
        $findmaxpenjamin++;
        return view('mpenjamin/p-create',compact('subtitle','icon','findmaxpenjamin'));
    }

    public function edit(Request $request){
        $data = Penjamin::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Penjamin';
        return view('mpenjamin/p-edit',compact('subtitle','icon','data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'prefix_antrean' => 'required',
        ],[
            'kode.required' => 'Kode Wajib Diisi',
            'nama.required' => 'Nama Wajib Diisi',
            'prefix_antrean.required' => 'Prefix Antrean Wajib Diisi',

        ]);
        Penjamin::create($request->all());
        return redirect('penjamin')->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'prefix_antrean' => 'required',
        ],[
            'kode.required' => 'Kode Wajib Diisi',
            'nama.required' => 'Nama Wajib Diisi',
            'prefix_antrean.required' => 'Prefix ANtrean Wajib Diisi',

        ]);
        $penjamin = Penjamin::find($id);
        $penjamin->update($request->all());
        return redirect('penjamin')->with('massage', 'Data Berhasil Diedit');
    }
}

