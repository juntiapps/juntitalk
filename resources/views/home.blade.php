@extends('layouts.app')

@section('title')
    Beranda
@endsection

@section('bodyclass')
    section
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buat Postingan</div>
                    <div class="card-body">
                        <form action="{{ route('store.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Ketik postingan" rows="3" name='post'
                                    id='post'></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture" name='picture'>
                                    <label class="custom-file-label" for="customFile">pilih gambar</label>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right" id='butpost'>Posting</button>
                        </form>
                    </div>
                </div>
                @forelse ($post->sortByDesc('created_at') as $item)
                    <div class="modal fade" id="postModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Menghapus Postingan
                                        id={{ $item->id }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <form method="post" action="{{ route('delete.post', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card pb-2">
                        <div class='card-header'>
                            <div class='row ml-2'>
                                <a href="{{route('show.profile',$item->user->name)}}">
                                <img src="{{ asset('ava/' . $item->user->profile->profile_picture) }}"
                                    class="rounded-circle" style="width: 40px; height:40px; object-fit:cover">
                                <div class="col">
                                    <strong>{{ $item->user->profile->display_name }}</strong></a>
                                    <p class="text-muted">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="float-right mr-3">
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @if (Auth::id() === $item->user_id)
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#postModal{{ $item->id }}">Hapus Postingan</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('show.post', $item->id) }}">Tampilkan
                                                Postingan</a>
                                        </div>
                                    </div>

                                </span>
                            </div>
                        </div>
                        <div class='card-body '>
                            <p>{{ $item->post }}</p>
                            @if ($item->picture !== '')
                                <div class="d-flex justify-content-center bg-dark">
                                    <img src="{{ asset('imagepost/' . $item->picture) }}" class="img-fluid">
                                </div>
                            @endif
                        </div>
                        <div class='card-footer'>
                            <ul class="nav">
                                <li class="nav-item">
                                    <p class="nav-link">{{ $item->like->count() }} suka </p>
                                </li>
                                <li class="nav-item">
                                    <p class="nav-link">{{ $item->comment->count() }} komentar </p>
                                </li>
                            </ul>
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    {{-- {{dd($item->like->where('user_id',Auth::id()))}} --}}
                                    @if ($item->like->where('user_id',Auth::id())->count()!==0)
                 
                                    <form method="POST" action="{{route('delete.like',$item->like->where('user_id',Auth::id())->first()->id)}}" >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-thumbs-up"></i>
                                            tidak suka</button>
                                    </form> 
                                    @else
                                    <form method="POST" action='{{route('store.like')}}'>
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$item->id}}">
                                        <button class="btn btn-info btn-sm" type="submit"><i class="far fa-thumbs-up"></i>
                                            suka</button>
                                    </form>
                                    @endif
                                </li>
                                <li class="nav-item">
                                    <button class="btn btn-info btn-sm" id='show_comment'
                                        onclick="$('#post{{ $item->id }}').slideToggle(500);">
                                        <i class="far fa-comment-alt"></i>
                                        komentar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="details px-3" style="display:none" id="post{{ $item->id }}">
                            <div class="px-3 my-2 row align-items-center">
                                <img src="{{ asset('ava/' . $item->user->profile->profile_picture) }}"
                                    class="rounded-circle my-1" style="width: 30px; height:30px; object-fit:cover">
                                <div class="col my-1">
                                    <form method="POST" action="{{ route('store.comment') }}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $item->id }}">
                                        <input type="text" class="form-control" placeholder="Tulis Komentar"
                                            name="comment">
                                </div>
                                <input class="btn btn-info btn-sm my-1" type="submit" id="button-addon2" value="Kirim">
                                </form>
                            </div>

                            @forelse ($item->comment->sortByDesc('created_at')->slice(0,5) as $comment)
                                <div class='px-3 my-2 row'>
                                    <a href="{{ route('show.profile', $comment->user->name) }}">
                                        <img src="{{ asset('ava/' . $comment->user->profile->profile_picture) }}"
                                            class="rounded-circle my-1"
                                            style="width: 30px; height:30px; object-fit:cover"></a>
                                    <div class="col-auto">
                                        <div class="px-2 py-1 rounded bg-dark">
                                            <small><a
                                                    href="{{ route('show.profile', $comment->user->name) }}">{{ $comment->user->profile->display_name }}</strong></a>
                                                <p>{{ $comment->comment }}</p>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                Balas<span
                                                    class="mx-3">{{ $comment->created_at->diffForHumans() }}</span>
                                                @if (Auth::id() === $comment->user_id)
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#commentModal{{ $comment->id }}">Hapus</a>
                                                @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="commentModal{{ $comment->id }}" tabindex="-1"
                                        aria-labelledby="commentModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Menghapus Komentar id={{ $comment->id }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <form method="post"
                                                        action="{{ route('delete.comment', $comment->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                            @if ($item->comment->count() > 5)
                                <a class="text-light" href="{{ route('show.post', $item->id) }}"> Tampilkan Komentar
                                    lainnya</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="justify-content-center"> Tidak ada postingan </p>
                @endforelse
            </div>
        </div>

    @endsection

    @push('script')
        <script>
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
        </script>
    @endpush
