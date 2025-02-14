@extends("layouts.default")
@section("title", "Versenyek")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row">

            <!-- Alert if there was an error -->
            <div class="alert alert-danger error-msg">
                Egyszer már felvetted
            </div>

            <h3> Fordulók</h3>
            <!-- Cards for the avalaible rounds -->
            @foreach ($rounds as $round)
                <div class="round">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">
                            {{$round->comp_name . ' - ' . $round->comp_year . ' - ' . $round->round_name}}
                        </div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">{{$round->round_start . "-től " . $round->round_end . '-ig'}}
                            </h5>
                            <p class="card-text">
                                {{$round->description}}
                                <br>Kérdések száma: {{$round->questions_number}}
                                <br>Pontok (Jó/Rossz/Üres):
                                {{$round->correct_point . '/' . $round->wrong_point . '/' . $round->blank_point}}

                                @if(strtotime($round->round_end) > strtotime(now()))
                                    <a href="javascript:void(0)" class="btn-sm btn btn-dark entryButton d-grid gap-2"
                                        data-id="{{$round->id}}">Benevezés</a>
                                @else
                                    <br> Vége a versenynek
                                @endif

                                <br> Eredménytábla
                                @foreach ($scoreBoard as $scores)
                                    @if($round->id == $scores->round_id)
                                        <br> {{$scores->placement . '. ' . $scores->user_email . ": " . $scores->points . " pont"}}
                                    @endif
                                @endforeach
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
        $('.error-msg').attr('hidden', true);

        //Joining rounds with the logged in user
        $('.entryButton').on('click', function () {
            let round_id = $(this).data('id');
            $('.error-msg').attr('hidden', true);
            $.ajax({
                url: '{{url("competitors", '')}}' + '/' + round_id + '/store',
                method: 'POST',
                success: function (response) {
                    swal("Sikeresen beneveztél!", response.success, "success");
                },
                error: function (error) {
                    $('.error-msg').attr('hidden', false);
                }
            });
        });
    });
</script>
@endsection