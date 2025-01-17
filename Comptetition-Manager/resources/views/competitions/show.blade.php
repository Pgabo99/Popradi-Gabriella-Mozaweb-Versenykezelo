@extends("layouts.default")
@section("title", "Versenyek")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row">
            @foreach ($competitions as $competition)
                <div class="col-sm-6 mb-3 mb-sm-0 competitions">
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
                                <br> Kattints további részletekért
                            <form id="compForm">
                                <input type="hidden" id="comp_name" value="{{$competition->comp_name}}">
                                <input type="hidden" id="comp_year" value="{{$competition->comp_year}}">
                            </form>
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {

        //Redirecting to the competitions rounds if clicking on a card
        $('.competitions').on('click', function () {
            let comp_name = $(this).find('#comp_name').val();
            let comp_year = $(this).find('#comp_year').val();
            window.location.href = '{{url("rounds", '')}}' + '/' + comp_name + '/' + comp_year + '/show';

        });
    });
</script>
@endsection