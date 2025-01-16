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


            @foreach ($rounds as $round)
                <div class="col-sm-6 mb-3 mb-sm-0 round">
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
                                <br> <a href="javascript:void(0)" class="btn-sm btn btn-dark entryButton d-grid gap-2"
                                    data-id="{{$round->id}}">Benevezés</a>
                            <form id="compForm">
                                <input type="hidden" id="round_id" value="{{$round->id}}">
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
        $('.error-msg').attr('hidden',true);

        //Joining rounds with the logged in user
        $('.entryButton').on('click', function () {
            let round_id = $(this).data('id');
            $('.error-msg').attr('hidden',true);
            $.ajax({
                url: '{{url("competitors", '')}}' + '/' + round_id + '/store',
                method: 'POST',
                success: function (response) {
                    swal("Sikeresen beneveztél!", response.success, "success");
                },
                error: function (error) {
                    $('.error-msg').attr('hidden',false);
                }
            });
        });
    });
</script>
@endsection