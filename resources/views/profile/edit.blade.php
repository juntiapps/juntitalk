@extends('layouts.app')

@section('title')
    Profil {{ Auth::user()->name }}
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
                                <img src="{{ asset('ava/' . $profile->profile_picture) }}"
                                    class="rounded-circle"
                                    style="object-fit:cover;height:170px;width:170px"
                                    >
                                <h2 class="title">Profil {{ $profile->display_name }}</h2>

                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update.profile', Auth::user()->name) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="picture" name='profile_picture'>
                                            <label class="custom-file-label" for="customFile">pilih foto profil</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name='display_name'
                                            value='{{ $profile->display_name }}'>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#datetimepicker4" name="birthday" value="{{$profile->birthday}}"/>
                                            <div class="input-group-append" data-target="#datetimepicker4"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name='gender_id'>
                                            @foreach ($gender as $item)
                                                @if ($item->id === $profile->gender_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->gender }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->gender }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name='status_id'>
                                            @foreach ($status as $item)
                                                @if ($item->id === $profile->status_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->status }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="address" class="form-control" rows="2">{{$profile->address}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea name="bio" class="form-control" rows="2">{{$profile->bio}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-warning" href="/">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
        $(function() {
            $('.datetimepicker-input').datetimepicker({
                format: 'D MMMM YYYY',
                icons: {
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        });
    </script>
@endpush
