@extends('layouts.app')
@section('title')
    Profil Arief
@endsection

@section('bodyclass')
    profile-page
@endsection

@section('content')
    <div class="wrapper">
        <div class="section" style="margin-top: 150px">
            <div class="container align-items-center">
                <div class="row">
                    <div class="col-lg-10 col-md-6 ml-auto mr-auto">
                        <div class="card card-coin card-plain">
                            <div class="card-header">
                                <img src="{{ asset('img/mike.jpg') }}" class="img-center img-fluid rounded-circle">
                                <h2 class="title">Profil Arief</h2>
                                <table class="table col-lg-4 mx-auto">
                                    <thead>
                                        <tr>
                                            <th>Postingan</th>
                                            <th>Komentar</th>
                                            <th>Balasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0</th>
                                            <td>0</th>
                                            <td>0</th>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Following</th>
                                            <th>Follower</th>
                                            <th>Suka</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0</th>
                                            <td>0</th>
                                            <td>0</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-tabs-primary justify-content-center">
                                        <li class="nav-item">
                                            <a class="nav-link active show" data-toggle="tab" href="#linka">
                                                Biodata
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linkb">
                                                Postingan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linkc">
                                                Komentar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linkd">
                                                Balasan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linke">
                                                Following
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linkf">
                                                Follower
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#linkg">
                                                Like
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-subcategories">
                                        <div class="tab-pane active show" id="linka">
                                            <div class="table-responsive ps">
                                                <table class="table col-lg">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td>Arief</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Lahir</th>
                                                        <td>6 Juli 1991</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jenis Kelamin</th>
                                                        <td>Laki-Laki</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>Belum Kawin</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td>Indramayu</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bio</th>
                                                        <td>Have a Nice Day</td>
                                                    </tr>
                                                </table>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                                    </div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="linkb">
                                            @php
                                                use Illuminate\Support\Str;
                                                $post = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem enim doloribus molestias eveniet reprehenderit. Dolorem velit non praesentium voluptates nostrum, sequi minima enim placeat aut quaerat odit alias at exercitationem.';
                                            @endphp
                                            @for ($i = 0; $i < 7; $i++)
                                                <div class="row mb-2">
                                                    <img class="img-thumbnail" src="{{ asset('img/denys.jpg') }}">
                                                    <div class="col">
                                                        <p class="text-muted">10 Agustus 2021</p>
                                                        <p>{{ Str::limit($post, 128) }}</p>
                                                        <a href="#">Lanjut Baca...</a>
                                                    </div>
                                                </div>
                                            @endfor    
                                        </div>
                                        <div class="tab-pane" id="linkc">
                                            @for ($i = 0; $i < 7; $i++)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="text-muted">10 Agustus 2021</p>
                                                        <p>{{ Str::limit($post, 128) }}</p>
                                                        <a href="#">Baca Postingan...</a>
                                                    </div>
                                                </div>
                                            @endfor  
                                        </div>
                                        <div class="tab-pane" id="linkd">
                                            @for ($i = 0; $i < 7; $i++)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="text-muted">10 Agustus 2021</p>
                                                        <p>{{ Str::limit($post, 128) }}</p>
                                                        <a href="#">Baca Postingan...</a>
                                                    </div>
                                                </div>
                                            @endfor  
                                        </div>
                                        <div class="tab-pane" id="linke">
                                            <div class="row">
                                            @for ($i = 0; $i < 7; $i++)
                                                    <div class="col-2 justify-content-center text-center my-2">
                                                        <img src="{{asset('img/lora.jpg')}}" alt="" class="rounded-circle" style="width:100px;height:100px;object-fit:cover">
                                                        <p>username</p>
                                                        <a href="#" class="btn btn-sm btn-info">Lihat Profile</a>
                                                        <a href="#" class="btn btn-sm btn-info btn-neutral">chat</a>
                                                    </div>
                                            @endfor  
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="linkf">
                                            <div class="row">
                                            @for ($i = 0; $i < 7; $i++)
                                                    <div class="col-2 justify-content-center text-center my-2">
                                                        <img src="{{asset('img/lora.jpg')}}" alt="" class="rounded-circle" style="width:100px;height:100px;object-fit:cover">
                                                        <p>username</p>
                                                        <a href="#" class="btn btn-sm btn-info">Lihat Profile</a>
                                                        <a href="#" class="btn btn-sm btn-info btn-neutral">chat</a>
                                                    </div>
                                            @endfor  
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="linkg">
                                            @for ($i = 0; $i < 7; $i++)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="text-muted">10 Agustus 2021</p>
                                                        <p>{{ Str::limit($post, 128) }}</p>
                                                        <a href="#">Baca Postingan...</a>
                                                    </div>
                                                </div>
                                            @endfor  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
