@extends("layouts.default")
@section("title", "Versenyeim")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row">

            <!-- Alert if there was an error -->
            <div class="alert alert-danger error-msg">
                Sikertelen, próbáld újra
            </div>
            <h3>Nevezett fordulóim</h3>
            <!-- Cards for the users rounds -->
            @foreach ($userRounds as $round)
                <div class=" round" id="{{$round->id}}">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">
                            {{$round->comp_name . ' - ' . $round->comp_year . ' - ' . $round->round_name}}
                        </div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">{{$round->round_start . "-től "}} <br>
                                {{ $round->round_end . '-ig'}}
                            </h5>
                            <p class="card-text">
                                {{$round->description}}
                                <br>Kérdések száma: {{$round->questions_number}}
                                <br>Pontok (Jó/Rossz/Üres):
                                {{$round->correct_point . '/' . $round->wrong_point . '/' . $round->blank_point}}
                                <br>Versenyző válaszai (Jó/Rossz/Üres):
                                {{$round->correct_answ . '/' . $round->wrong_answ . '/' . $round->blank_answ}}
                                <br>Helyezés - összpontszám:
                                {{$round->placement . ' - ' . $round->points}}

                                @if(strtotime($round->round_end) > strtotime(now()))
                                    <br> <a href="javascript:void(0)" class="btn-sm btn btn-dark entryButton d-grid gap-2"
                                        data-id="{{$round->id}}" data-user_email="{{$round->user_email}}">Visszalépés a
                                        versenyből</a>
                                @endif
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

        //Delete betton
        $('.entryButton').on('click', function () {
            let round_id = $(this).data('id');
            let user_email = $(this).data('user_email');
            if (confirm("Biztos hogy törölni akarod?")) {

                $.ajax({
                    url: '{{url("competitors", '')}}' + '/' + user_email + '/' + round_id + '/delete',
                    method: 'DELETE',
                    success: function (response) {
                        $('#' + round_id).attr('hidden', true);
                        swal("Sikeres törlés!", response.success, "success");
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        });
    });
</script>
@endsection