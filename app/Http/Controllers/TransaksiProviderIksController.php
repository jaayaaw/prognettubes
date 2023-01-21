<?php

namespace App\Http\Controllers;

use App\Models\ProviderIks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiProviderIksController extends Controller
{
    public function index($id, $nama){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Transaksi Provider IKS';
        $table_id = 't_iks_provider';
        return view('tprovideriks/tp-list',compact('subtitle','table_id','icon','id','nama'));
    }

    public function listData(Request $request){
        $data = ProviderIks::with('iksIdSel')->where('iks_id',$request->id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    \Log::info($data->iksIdSel);
                    $aksi = "";
                    $aksi .= "<a title='Detail Transaksi' href='/tkomponeniks/".$data->id."/".$data->iksIdSel->nama."' class='btn btn-md btn-info' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-info' ></i></a> &nbsp"; 
                    $aksi .= "<a title='Edit Data' href='/provideriks/".$data->id."/".$data->iksIdSel->nama."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil'></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama_iks}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nim='{$data->nama}' style='margin-top: 5px'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom'></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(ProviderIks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id, $nama){
        // $findmaxiks = -1;
        // $getData = ProviderIks::all();
        // foreach($getData as $gd)
        // {
        //     if($gd->iks_id > $findmaxiks)
        //     {
        //         $findmaxiks = $gd->iks_id;
        //     }
        // }
        // $findmaxiks;
        // $iksid = ProviderIks::where('iks_id',$id)->first();
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Provider IKS';
        return view('tprovideriks/createprovider',compact('subtitle','icon','id','nama'));
    }

    public function edit(Request $request, $id, $nama){
        // $providerid = ProviderIks::where('iks_id',$request->id)->get();
        $data = ProviderIks::find($request->id);
        if ($request->hasFile('iks_file')) {
            // Do something with the file
            $file = $request->file('iks_file');
        }
        
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Provider IKS';
        return view('tprovideriks/editprovider',compact('subtitle','icon','data','id','nama'));
    }

    public function store(Request $request, $nama)
    {
        $request->validate([
            'iks_id' => 'required|numeric',
            'nomor_iks' => 'required|numeric',
            'nama_iks' => 'required',
            'tanggal_awal' => 'required|before:tanggal_akhir',
            'tanggal_akhir' => 'required|after:tanggal awal',
            'iks_file' => 'required'
        ],[
            'iks_id.required' => 'Iks Id Wajib Diisi!',
            'iks_id.numeric' => 'Kolom Iks Id Hanya Boleh Angka!',
            'nomor_iks.required' => 'Nomor Iks Wajib Diisi!',
            'nama_iks.required' => 'Nama Wajib Diisi',
            'tanggal_awal.required' => 'Tanggal Awal Wajib Diisi',
            'tanggal_awal.before' => 'Tanggal Awal Tidak Boleh Lebih Besar Dari Tanggal Akhir',
            'tanggal_akhir.required' => 'Tanggal Akhir Wajib Diisi',
            'iks_file.required' => 'Iks File Wajib Diisi'
        ]);

        $iks_file = $request->file('iks_file');
        $nama_dok = 'IKS'.date('Ymdhis').'.'.$request->file('iks_file')->getClientOriginalExtension();
        $iks_file->move('dokumen/', $nama_dok);

        ProviderIks::create([
            'id' => ProviderIks::max('id')+1,
            'iks_id' => $request->iks_id,
            'nomor_iks' => $request->nomor_iks,
            'nama_iks'=> $request->nama_iks,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'iks_file' => $nama_dok
        ]);
        return redirect()->route('provideriks.list', [$request->iks_id, $nama])->with('massage', 'Berhasil Menambahkan Data Baru');
    }

    public function update(Request $request, $id, $nama)
    {
        $request->validate([
            'iks_id' => 'required|numeric',
            'nomor_iks' => 'required|numeric',
            'nama_iks' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'iks_file' => 'required'
        ],[
            'iks_id.required' => 'Iks Id Wajib Diisi!',
            'iks_id.numeric' => 'Kolom Iks Id Hanya Boleh Angka!',
            'nomor_iks.required' => 'Nomor Iks Wajib Diisi!',
            'nama_iks.required' => 'Nama Wajib Diisi',
            'tanggal_awal.required' => 'Tanggal Awal Wajib Diisi',
            'tanggal_akhir.required' => 'Tanggal Akhir Wajib Diisi',
            'iks_file.required' => 'Iks File Wajib Diisi'
        ]);

        $iks_file = $request->file('iks_file');
        $nama_dok = 'IKS'.date('Ymdhis').'.'.$request->file('iks_file')->getClientOriginalExtension();
        $iks_file->move('dokumen/', $nama_dok);

        $iks = ProviderIks::find($id);
        $iks->update([
            'iks_id' => $request->iks_id,
            'nomor_iks' => $request->nomor_iks,
            'nama_iks'=> $request->nama_iks,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'iks_file' => $nama_dok
        ]);
        return redirect()->route('provideriks.list', [$request->iks_id, $nama])->with('massage', 'Data Berhasil Diedit');
    }
}
