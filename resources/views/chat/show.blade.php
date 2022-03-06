@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('bodyclass')
    index-page
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="card" style="height: 80vh;max-height: 80vh;">
                <div class="card-body h-100">
                    <div class='row h-100'>
                        <div class="col mx-1 d-flex flex-column h-100">
                            <div class='row align-items-center p-2 bg-info rounded-top' style="cursor:pointer;">
                                <img src="{{ asset('ava/' . $user->profile->profile_picture) }}" class="rounded-circle"
                                    style="width: 40px; height:40px; object-fit:cover">
                                <div class="col">
                                    <strong class="text-white">{{ $user->profile->display_name }}</strong>
                                </div>
                                <span class="float-right mr-3">
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            {{-- @if (Auth::id() === $item->user_id)
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#postModal{{ $item->id }}">Hapus Postingan</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('show.post', $item->id) }}">Tampilkan
                                            Postingan</a> --}}
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="row bg-light justify-content-start rounded-bottom"
                                style="overflow-y:auto; height:100%" id="chat_container">
                                <div class="col conversation" id="conversation"></div>
                            </div>

                            <form method="POST" enctype="multipart/form-data" id="sendchat">
                                @csrf
                                <input type="hidden" name="to_user_id" value="{{ $user->id }}" id="to_user_id">
                                <div class="row align-items-center">
                                    <input type="file" id="picture" name="picture" accept="image/*" hidden>
                                    <label id="custom-label" for='picture' class="btn btn-info btn-sm py-2"
                                        style="display: inline-block"><i class="fas fa-paperclip fa-1x"></i></label>
                                    <div class="col my-1">
                                        <input type="text" class="form-control" placeholder="Tulis pesan" name="chat"
                                            id="chat">
                                    </div>
                                    <button class="btn btn-info btn-sm py-2" id="sendchats" type="button"><i
                                            class="fas fa-paper-plane"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- {{dd($id)}} --}}
@endsection

@push('script')
    <script>
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#custom-label').html(fileName);
        });
    </script>
    <script src="{{ asset('js/get.js') }}"></script>
    <script>
        var URL = `{{ route('retrieve.chat', $id) }}`
        var auth_id = "{{ Auth::id() }}";
        var asset = "{{ asset('imagechat') }}"
        get(URL, auth_id, asset)
        // setTimeout(() => {
        //     var posArray = $('.scroll').offset();
        // console.log(posArray.top)
        // $('#chat_container').scrollTop(posArray.top);
        // }, 1000);
        // var posArray = $('.scroll').offset();
        // console.log(posArray.top)
        // $('#chat_container').scrollTop(posArray.top);
        // setInterval(() => {
        //     get(URL,auth_id,asset)
        // }, 5000);
    </script>
    <script>
        $('#sendchats').click(function(e) {
            let form = $('#sendchat')
            let formData = new FormData(form[0]);

            $.ajax({
                url: "{{ route('store.chat') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    // console.log("res", response);
                    if (response.status == 200) {
                        // setTimeout(() => {
                        get(URL, auth_id, asset)
                        // }, 1000);
                    }
                },
                error: function(error) {
                    console.log("error", error.responseJSON.errors);
                }
            });
            // console.log("before",$('#picture').val())

            form.trigger("reset")
            $('#custom-label').html('<i class="fas fa-paperclip fa-1x"></i>');
        });
    </script>
@endpush
