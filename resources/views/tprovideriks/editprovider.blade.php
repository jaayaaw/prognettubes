{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')

@endsection
@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <!-- <em class="icon ni ni-search"></em> -->
        <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='{{$subtitle}}'></i>  {{strtoupper($subtitle)}}</h4>
    </div>
    <div class="nk-fmg-actions">
        <div class="btn-group">
            <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
            <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <a href="/provideriks/{{ App\Models\ProviderIks::where('id',$id)->pluck('iks_id')->first() }}/{{ $nama }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
        </div>
    </div>

</div>
<div class="row gy-3 d-none" id="loaderspin">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
            &nbsp;
        </div>
        <div class="d-flex align-items-center">
          <div class="col-md-12" align="center">
            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
          </div>
        </div>
        <div class="col-md-12" align="center">
            <strong>Loading...</strong>
        </div>
    </div>
</div>
<div class="card d-none" id="filterrow">
    <div class="card-body" style="background:#f7f9fd">
        <div class="row gy-3" >
            
        </div>
    </div>
    <!-- <div class="card-footer" style="background:#fff" align="right"> -->
    <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
        <div class="btn-group">
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em class="icon ti-reload"></em> <span>Submit Filter</span></a>
        </div>
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
<div class="nk-fmg-quick-list nk-block">
    <div class="card">
        <div class="card-body">
        <h4>{{ $nama }}</h4><br>
        <form method="POST" action="{{ route('provideriks.update', [$id, $nama]) }}" id="form1" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="iks_id" class="col-sm-2 col-form-label">IKS ID</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="iks_id" name="iks_id" value="{{ $data['iks_id'] }}">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="nomor_iks" class="col-sm-2 col-form-label">NOMOR IKS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('nomor_iks') is-invalid @enderror" id="nomor_iks" name="nomor_iks" value="{{ $data['nomor_iks'] }}">
                        @error('nomor_iks')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
            </div>       
            <div class="mb-3 row">
                <label for="nama_iks" class="col-sm-2 col-form-label">NAMA IKS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('nama_iks') is-invalid @enderror" id="nama_iks" name="nama_iks" value="{{ $data['nama_iks'] }}">
                        @error('nama_iks')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_awal" class="col-sm-2 col-form-label">TANGGAL AWAL</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror" id="tanggal_awal" name="tanggal_awal" value="{{ $data['tanggal_awal'] }}">
                        @error('tanggal_awal')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_akhir" class="col-sm-2 col-form-label">TANGGAL AKHIR</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ $data['tanggal_akhir'] }}">
                        @error('tanggal_akhir')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="iks_file" class="col-sm-2 col-form-label">IKS FILE</label>
                    <div class="col-sm-10">
                        <span id="documentName">{{ $data['iks_file'] }}</span>
                        <input type="file" class="form-control @error('iks_file') is-invalid @enderror" id="iks_file" name="iks_file" value="{{ $data['iks_file'] }}"><br>
                        @error('iks_file')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
            </div>
            <div>
                <button type="button" form="form1" onclick="confirmUpdate(this)" class="btn btn-sm btn-success" value="Submit" style="float: right;">Perbaharui Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- </div> -->

@endsection

@push('script')

<script>
    function confirmUpdate() {
        CustomSwal.fire({
            icon:'question',
            text: 'Yakin Untuk Perbaharui Data ?',
            showCancelButton: true,
            confirmButtonText: 'Perbaharui Data',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form1").submit()
            }else{
        }
        });
    }  
</script>

@endpush