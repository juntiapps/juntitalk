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
                    <div class="col-lg-10 col-md-6 mx-auto">
                        <div class="card card-coin card-plain">
                            <div class="card-header">
                                <img src="{{ asset('ava/' . $profile->profile_picture) }}"
                                    class="img-center img-fluid rounded-circle">
                                <h2 class="title">Profil {{ $profile->display_name }}
                                    @if (Auth::id() === $profile->user_id)
                                        <span><a class="btn btn-success btn-sm"
                                                href="{{ route('edit.profile', Auth::user()->name) }}">Sunting
                                                Profil Saya</a></span>
                                    @else
                                        <span>
                            
                                            @if ($profile->user->follow->where('follower_id',Auth::id())->count()!=0)
                                            {{-- {{dd()}} --}}
                                            <form action="{{ route('delete.follow', $profile->user->follow->where('follower_id',Auth::id())->first()->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary btn-sm" href="">mengikuti</button>
                                            </form>
                                            @else 
                                            <form action="{{ route('store.follow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name='user_id' value="{{$profile->user_id}}">
                                                <button type="submit" class="btn btn-info btn-sm" href="">ikuti</button>
                                            </form>
                                            @endif
                                            
                                        </span>
                                    @endif
                                </h2>
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
                                            <td>{{ $profile->user->post->count() }}</td>
                                            <td>{{ $profile->user->comment->count() }}</td>
                                            <td>{{ $profile->user->reply->count() }}</td>
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

                            </div>
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
                                    @if (Auth::id() === $profile->user_id)
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
                                    @else

                                    @endif

                                </ul>
                                <div class="tab-content tab-subcategories">
                                    <div class="tab-pane active show" id="linka">
                                        <div class="table-responsive ps">
                                            <table class="table">
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>{{ $profile->display_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>{{ $profile->birthday }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    @if ($profile->gender_id == 1)
                                                        <td>Rahasia</td>
                                                    @else
                                                        <td>{{ $profile->gender->gender }}</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    @if ($profile->gender_id == 1)
                                                        <td>Rahasia</td>
                                                    @else
                                                        <td>{{ $profile->status->status }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $profile->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bio</th>
                                                    <td>{{ $profile->bio }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="linkb">
                                        @php
                                            use Illuminate\Support\Str;
                                            $post = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem enim doloribus molestias eveniet reprehenderit. Dolorem velit non praesentium voluptates nostrum, sequi minima enim placeat aut quaerat odit alias at exercitationem.';
                                            // dd($profile->user->post);
                                        @endphp
                                        @forelse ($profile->user->post as $item)
                                            <div class="row mb-2">
                                                @if ($item->picture != '')
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('imagepost/' . $item->picture) }}">
                                                @endif
                                                <div class="col">
                                                    <p class="text-muted">{{ $item->created_at }}</p>
                                                    <p>{{ Str::limit($item->post, 128) }}</p>
                                                    <a href="#">Lanjut Baca...</a>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Tidak ada Postingan</p>
                                        @endforelse
                                        {{-- @for ($i = 0; $i < 7; $i++)
                                            <div class="row mb-2">
                                                <img class="img-thumbnail" src="{{ asset('img/denys.jpg') }}">
                                                <div class="col">
                                                    <p class="text-muted">10 Agustus 2021</p>
                                                    <p>{{ Str::limit($post, 128) }}</p>
                                                    <a href="#">Lanjut Baca...</a>
                                                </div>
                                            </div>
                                        @endfor --}}
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
                                                    <img src="{{ asset('img/lora.jpg') }}" alt="" class="rounded-circle"
                                                        style="width:100px;height:100px;object-fit:cover">
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
                                                    <img src="{{ asset('img/lora.jpg') }}" alt="" class="rounded-circle"
                                                        style="width:100px;height:100px;object-fit:cover">
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
    </div>
@endsection
