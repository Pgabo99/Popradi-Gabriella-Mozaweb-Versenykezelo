@extends("layouts.default")
@section("title", "Versenyek")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row">
            @foreach ($competitions as $competition)
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">{{$competition->comp_name . ' - ' . $competition->comp_year}}</div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">{{$competition->comp_start . "-től " . $competition->comp_end . '-ig'}}
                            </h5>
                            <p class="card-text">
                            {{$competition->description}}
                            <br>Helyszín: {{$competition->address}}
                            <br>Elérhető nyelvek: {{$competition->languages}}
                            <br>Nyeremény: {{$competition->prize}} Ft
                            <br>Nevezési díj: {{$competition->entry_fee}} Ft
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</main>
@endsection