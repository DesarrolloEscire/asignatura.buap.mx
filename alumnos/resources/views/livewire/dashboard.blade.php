<div style="margin-left:-1.5rem;margin-right:-1.5rem;display:block;">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="banner-section">
        <div id="carouselBanners" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselBanners" data-slide-to="0" class="active"></li>
                <li data-target="#carouselBanners" data-slide-to="1"></li>
                <li data-target="#carouselBanners" data-slide-to="2"></li>
                <li data-target="#carouselBanners" data-slide-to="3"></li>
                <li data-target="#carouselBanners" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ url('/img/dashboard/banners/1.jpg') }}?{{ date('Ymdhis') }}" alt=""
                        class="background-img">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/img/dashboard/banners/2.jpg') }}?{{ date('Ymdhis') }}" alt=""
                        class="background-img">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/img/dashboard/banners/3.jpg') }}?{{ date('Ymdhis') }}" alt=""
                        class="background-img">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/img/dashboard/banners/4.jpg') }}?{{ date('Ymdhis') }}" alt=""
                        class="background-img">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/img/dashboard/banners/5.jpg') }}?{{ date('Ymdhis') }}" alt=""
                        class="background-img">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselBanners" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselBanners" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- REA -->
                <div class="row justify-content-center row-section">
                    <div class="col-12">
                        <h2 class="blue-text title-text">REA</h2>
                        <hr>
                    </div>
                    <div class="text-center col-12 col-md-3">
                        <a href="https://ecosistema.buap.mx/rea/reas" target="_BLANK"
                            class="btn-circle blue-background">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </a>
                        <strong class="blue-text">Curso REA</strong>
                    </div>
                    <div class="text-center col-12 col-md-3">
                        <a href="https://ecosistema.buap.mx/rea/repositories" target="_BLANK"
                            class="btn-circle blue-background">
                            <i class="fas fa-clipboard-list"></i>
                        </a>
                        <strong class="blue-text">Evalúa tu REA</strong>
                    </div>
                    <div class="text-center col-12 col-md-3">
                        <a href="#" class="btn-circle blue-background" title="Próximamente">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </a>
                        <strong class="blue-text">Publica tu REA</strong>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- Asignaturas -->
                <div class="row justify-content-center row-section">
                    <div class="col-12">
                        <h2 class="blue-text title-text">Asignaturas</h2>
                        <hr>
                    </div>
                    <div class="text-center col-12 col-md-3">
                        <a href="{{ route('subjects.index') }}" class="btn-circle light-blue-background">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <strong class="blue-text">Programa de asignaturas</strong>
                    </div>
                    <div class="text-center col-12 col-md-3">
                        <a href="{{ route('plannings.index') }}" class="btn-circle light-blue-background">
                            <i class="fas fa-cogs"></i>
                        </a>
                        <strong class="blue-text">Planeaciones didácticas</strong>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
