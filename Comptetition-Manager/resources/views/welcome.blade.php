@extends("layouts.default")
@section("title", "Kezdőoldal")
@section("content")
<main class="mt-5">
    <div class="container">

        <!-- Alert if everything went smooth -->
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{session()->get("success")}}
            </div>
        @endif

        <!-- Alert if there was an error -->
        @if(session()->has("message"))
            <div class="alert alert-warning">
                {{session()->get("message")}}
            </div>
        @endif

        @if(auth()->user()->user_type=='Admin')
        <!-- New Competition-->
        <div class="d-grid gap-2">
            <a href="{{route("competitions.create")}}" class="btn btn-dark">Új verseny
                felvétele</a>
        </div>
        @else
         <!-- Avalaible Competitions-->
         <div class="d-grid gap-2">
            <a href="{{route("competitions.show")}}" class="btn btn-dark">Versenyek böngészése</a>
        </div>
        @endif

        <!-- Slides -->
        <div id="carouselExampleIndicators" class="carousel slide border rounded">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1589556264800-08ae9e129a8c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 rounded" alt="cycling">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1530138948699-6a75eebc9d9b?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 rounded" alt="swimming">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1486260713155-8095db2d9954?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 rounded" alt="baseball">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </div>
</main>
@endsection