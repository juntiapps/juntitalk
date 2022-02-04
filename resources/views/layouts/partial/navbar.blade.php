<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/" rel="tooltip" title="Sosial Media Junti" data-placement="bottom">
                <span>JuntiTalk•</span> Sosial Media Junti
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a>
                            JuntiTalk•
                        </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a class='nav-link' href="{{ url('/home') }}">Beranda</a></li>
                    @else
                        <li class="nav-item"><a class='nav-link' href="{{ route('register') }}">Daftar</a></li>

                        @if (Route::has('register'))
                            <li class="nav-item"><a class='nav-link' href="{{ route('login') }}">Masuk</a>
                            <li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>