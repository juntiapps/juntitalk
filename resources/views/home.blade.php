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
                        <form action="/home" method="POST" enctype="multipart/form-data">
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
                @forelse ($post as $item)
                    <div class="card">
                        <div class='card-header'>
                            <div class='row ml-2'>
                                <img src="{{ asset('ava/' . $item->user->profile->profile_picture) }}"
                                    class="rounded-circle" style="width: 40px; height:40px; object-fit:cover">
                                <div class="col">
                                    <strong>{{ $item->user->profile->display_name }}</strong>
                                    <p class="text-muted">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class='card-body d-flex justify-content-center'>
                            <img src="{{ asset('imagepost/' . $item->picture) }}" class="img-fluid">
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
                                    <button class="btn btn-info btn-sm"><i class="far fa-thumbs-up"></i> suka</button>
                                </li>
                                <li class="nav-item">
                                    <button class="btn btn-info btn-sm" id='show_comment'
                                        onclick="$('.details').slideToggle(function(){$('#show_comment').html($('.details').is(':visible')?
                                                        `<i class='far fa-comment-alt'></i> komentar`: `<i class='far fa-comment-alt'></i> komentar`);});">
                                        <i class="far fa-comment-alt"></i>
                                        komentar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="details px-3" style="display:none">
                            <div class="px-3 my-2 row align-items-center">
                                <img src="{{ asset('ava/' . $item->user->profile->profile_picture) }}"
                                    class="rounded-circle my-1" style="width: 30px; height:30px; object-fit:cover">
                                <div class="col my-1">
                                    <form method="POST" action="{{ route('store.comment') }}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $item->id }}">
                                        <input type="text" class="form-control" placeholder="Tulis Komentar"
                                            name="comment">
                                        {{-- <div class="float-right"> --}}
                                </div>
                                <input class="btn btn-info btn-sm my-1" type="submit" id="button-addon2" value="Kirim">
                                {{-- </div> --}}
                                </form>
                            </div>
                            @if ($item->comment->count() > 5)
                                <p class="text-muted"> Tampilak Komentar lainnya</p>
                            @endif
                            @forelse ($item->comment as $item)
                                <div class='px-3 my-2 row align-items-center'>
                                    <img src="{{ asset('ava/' . $item->user->profile->profile_picture) }}"
                                        class="rounded-circle my-1" style="width: 30px; height:30px; object-fit:cover">
                                    <div class="col">
                                        <div class="p-2 rounded bg-dark">
                                            <small><strong>{{ $item->user->profile->display_name }}</strong>
                                                <p>{{ $item->comment }}</p>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                Reply<span
                                                    class="ml-5">{{ $item->created_at->diffForHumans() }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @empty

                            @endforelse
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
