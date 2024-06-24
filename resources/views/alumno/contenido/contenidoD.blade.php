<h2>Contenido Destacado</h2>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($materialesDestacados as $key => $material)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <a href="{{ route('alumno.contenido.show', $material->id) }}">
                    <img src="{{ asset('storage/materiales/' . $material->imagen) }}" class="w-auto"
                        alt="{{ $material->titulo }}">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $material->titulo }}</h5>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
