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
            <a href="{{ route('penjamin.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
        <form method="POST" action="{{ url('penjamin') }}/{{ $data['id'] }}" id="form1">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="kode" name="kode" value="{{ $data['kode'] }}">
                    </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $data['nama'] }}">
                    </div>
                    @error('nama')
                        <div class="invalid-feedback d-block" style="margin-left: 210px;">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Prefix Antrean</label>
                    <div class="col-sm-7">
                            <input type="text" class="form-control @error('prefix_antrean') is-invalid @enderror" id="prefix_antrean" name="prefix_antrean" value="{{ $data['prefix_antrean'] }}">
                    </div>
                    @error('prefix_antrean')
                        <div class="invalid-feedback d-block" style="margin-left: 210px;">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
            </div>
            <div>
                <button type="button" form="form1" onclick="confirmUpdate(this)" class="btn btn-sm btn-success" value="Submit" style="float: right;">Update Data</button>
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
            text: 'Data Sudah Benar ?',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
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
