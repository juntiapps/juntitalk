@extends('layouts.app')

@section('title')
    Welcome
@endsection

@section('bodyclass')
    landing-page
@endsection

@section('content')
<div class="wrapper">
    <div class="page-header">
        <img src="{{ asset('img/blob.png') }}" class="path">
        <img src="{{ asset('img/path2.png') }}" class="path2">
        <img src="{{ asset('img/triunghiuri.png') }}" class="shapes triangle">
        <img src="{{ asset('img/waves.png') }}" class="shapes wave">
        <img src="{{ asset('img/patrat.png') }}" class="shapes squares">
        <img src="{{ asset('img/cercuri.png') }}" class="shapes circle">
        <div class="content-center">
            <div class="row row-grid justify-content-between align-items-center text-left">
                <div class="col-lg-6 col-md-6">
                    <h1 class="text-white">Selamat Datang Di
                        <br>
                        <span class="text-white"><strong>JuntiTalk</strong></span>
                    </h1>
                    <p class="text-white mb-3">Sosial Media Orang Junti</p>
                    <p class="text-white mb-3">Silahkan Daftar jika belum memiliki akun, atau Silahkan Masuk jika
                        sudah memiliki akun</p>
                    <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                    <a class="btn btn-primary btn-neutral" href="{{ route('login') }}">Masuk</a>

                </div>
                <div class="col-lg-5 col-md-6">
                    <img src="{{ asset('img/Social-Media-2.svg') }}" alt="Circle image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection