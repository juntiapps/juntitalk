@extends('layouts.app')
@section('title')
    {{ $post->user->profile->display_name }}
@endsection

@section('bodyclass')
    section
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Menghapus Postingan
                                    id={{ $post->id }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <form method="post" action="{{ route('delete.post', $post->id) }}">
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
                            <a href="{{ route('show.profile', $post->user->name) }}">
                                <img src="{{ asset('ava/' . $post->user->profile->profile_picture) }}"
                                    class="rounded-circle" style="width: 40px; height:40px; object-fit:cover">
                                <div class="col">
                                    <strong>{{ $post->user->profile->display_name }}</strong>
                            </a>
                            <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        @if (Auth::id() === $post->user_id)
                            <span class="float-right mr-3">
                                <div class="dropdown">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#postModal">Hapus
                                            Postingan</a>
                                    </div>
                                </div>
                            </span>
                        @endif
                    </div>
                    <div class='card-body '>
                        <p>{{ $post->post }}</p>
                        @if ($post->picture !== '')
                            <div class="d-flex justify-content-center bg-dark">
                                <img src="{{ asset('imagepost/' . $post->picture) }}" class="img-fluid">
                            </div>
                        @endif
                    </div>
                    <div class='card-footer'>
                        <ul class="nav">
                            <li class="nav-item">
                                <p class="nav-link">{{ $post->like->count() }} suka </p>
                            </li>
                            <li class="nav-item">
                                <p class="nav-link">{{ $post->comment->count() }} komentar </p>
                            </li>
                        </ul>
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                {{-- {{dd($item->like->where('user_id',Auth::id()))}} --}}
                                @if ($post->like->where('user_id', Auth::id())->count() !== 0)
                                    <form method="POST"
                                        action="{{ route('delete.like', $post->like->where('user_id', Auth::id())->first()->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-thumbs-up"></i>
                                            tidak suka</button>
                                    </form>
                                @else
                                    <form method="POST" action='{{ route('store.like') }}'>
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button class="btn btn-info btn-sm" type="submit"><i class="far fa-thumbs-up"></i>
                                            suka</button>
                                    </form>
                                @endif
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-info btn-sm">
                                    <i class="far fa-comment-alt"></i>
                                    komentar
                                </button>
                            </li>
                        </ul>

                        <div class="px-3 my-2 row align-items-center">
                            <img src="{{ asset('ava/' . $post->user->profile->profile_picture) }}"
                                class="rounded-circle my-1" style="width: 30px; height:30px; object-fit:cover">
                            <div class="col my-1">
                                <form method="POST" action="{{ route('store.comment') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="text" class="form-control" placeholder="Tulis Komentar" name="comment">
                            </div>
                            <input class="btn btn-info btn-sm my-1" type="submit" id="button-addon2" value="Kirim">
                            </form>
                        </div>

                        @forelse ($post->comment->sortByDesc('created_at') as $comment)
                            <div class='px-3 my-2 row'>
                                <a href="{{ route('show.profile', $comment->user->name) }}">
                                    <img src="{{ asset('ava/' . $comment->user->profile->profile_picture) }}"
                                        class="rounded-circle my-1" style="width: 30px; height:30px; object-fit:cover"></a>
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
                                                <form method="post" action="{{ route('delete.comment', $comment->id) }}">
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
                            <blockquote type="blockquote text-center">tidak ada komentar</blockquote>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
