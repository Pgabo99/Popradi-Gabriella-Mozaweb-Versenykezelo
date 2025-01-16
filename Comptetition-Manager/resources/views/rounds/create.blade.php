@extends("layouts.default")
@section("title", "Fordulók")
@section("content")
<main class="mt-5">
    <div class="container">
        <!-- Modal -->
        <div class="modal fade roundModel" id="Round" tabindex="-1" aria-labelledby="RoundTitle" aria-hidden="true">
            <form id="roundForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="RoundTitle"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="round_edit" class="form-control" name="round_edit">

                            <!-- Rounds name -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Forduló neve" id="round_name" class="form-control"
                                    name="round_name" required autofocus>
                                <span id="roundNameError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Round start -->
                            <div class="form-group mb-3">
                                <label for="round_start" class="form-label">Forduló kezdete</label>
                                <input type="datetime-local" min="<?= date('Y-m-d'); ?>" id="round_start"
                                    class="form-control" name="round_start" required>
                                <span id="roundStartError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Round end -->
                            <div class="form-group mb-3">
                                <label for="round_end" class="form-label">Forduló vége</label>
                                <input type="datetime-local" min="<?= date('Y-m-d'); ?>" id="round_end"
                                    class="form-control" name="round_end" required>
                                <span id="roundEndError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Description-->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Leírás" id="description" class="form-control"
                                    name="description">
                                <span id="descriptionError" class="text-danger error-msg"></span>
                            </div>


                            <!-- Competitions-->
                            <div class="form-group mb-3">
                                <label for="competition" class="form-label">Versenyek</label>
                                <select class="form-control" id="competition" name="competition" required>
                                    @foreach ($compString as $competition){
                                        <option value="{{$competition}}">{{$competition}}</option>
                                        }

                                    @endforeach
                                </select>
                                <span id="competitionError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Questions Number-->
                            <div class="form-group mb-3">
                                <label for="questions_number" class="form-label">Kérdések száma</label>
                                <input type="number" min="0" value="100" id="questions_number" class="form-control"
                                    name="questions_number" required>
                                <span id="questionsNumberError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Correct point-->
                            <div class="form-group mb-3">
                                <label for="correct_point" class="form-label">Pont helyes válaszért</label>
                                <input type="number" min="0" value="0" id="correct_point" class="form-control"
                                    name="correct_point" required>
                                <span id="correctPointError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Wrong point-->
                            <div class="form-group mb-3">
                                <label for="wrong_point" class="form-label">Pont rossz válaszért</label>
                                <input type="number" min="0" value="0" id="wrong_point" class="form-control"
                                    name="wrong_point" required>
                                <span id="wrongPointError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Blank point-->
                            <div class="form-group mb-3">
                                <label for="blank_point" class="form-label">Pont üres válaszért</label>
                                <input type="number" min="0" value="0" id="blank_point" class="form-control"
                                    name="blank_point" required>
                                <span id="blankPointError" class="text-danger error-msg"></span>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                            <button type="button" class="btn btn-primary" id="roundSaveBTn">Mentés</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Round"
                        id="addRound" width="100%">
                        Új forduló felvétele
                    </button>
                </div>
                <select class="form-control" id="competitionSelect" name="competitionSelect">
                    <option value="all" selected>Verseny választása...</option>
                    @foreach ($compString as $competition){
                        <option value="{{$competition}}">{{$competition}}</option>
                        }
                    @endforeach
                </select>
            </div>
            <!-- Rounds table-->
            <div class="card-body">
                <div class="table-responsive card-text">
                    <table class="table table-sm table-hover caption-bottom align-middle table-bordered"
                        id="rounds-table">
                        <caption>Fordulók listája</caption>
                        <thead class="table-light align-middle">
                            <tr>
                                <th colspan="12" style="text-align: center;">Fordulók</th>
                            </tr>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Forduló neve</th>
                                <th scope="col">Verseny neve</th>
                                <th scope="col">Verseny éve</th>
                                <th scope="col">Leírás</th>
                                <th scope="col">Kérdések száma</th>
                                <th scope="col">Mettől</th>
                                <th scope="col">Meddig</th>
                                <th scope="col" colspan="3">Pontok <br> Helyes/Rossz/Üres</th>
                                <th scope="col">Művelet</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {

        //Rounds Table
        var table = $('#rounds-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('rounds.index')}}",
            columns: [
                { data: 'id' },
                { data: 'round_name' },
                { data: 'comp_name' },
                { data: 'comp_year' },
                { data: 'description' },
                { data: 'questions_number' },
                { data: 'round_start' },
                { data: 'round_end' },
                { data: 'correct_point' },
                { data: 'wrong_point' },
                { data: 'blank_point' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });

        $('.error-msg').html('');

        //Saving/Updating data
        var form = $('#roundForm')[0];
        $('#roundSaveBTn').click(function () {

            $('roundSaveBTn').attr('disabled', true);
            $('roundSaveBTn').html('Folyamatban...');

            var formData = new FormData(form);

            $.ajax({
                url: '{{route("rounds.store")}}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    table.draw();
                    $('.roundModel').modal('hide');
                    $('roundSaveBTn').attr('disabled', false);
                    $('roundSaveBTn').html('Mentés');
                    $('.error-msg').html('');
                    if (response) {
                        swal("Sikeres mentés!", response.success, "success");
                    }
                },
                error: function (error) {
                    if (error) {
                        $('#roundNameError').html(error.responseJSON.errors.round_name);
                        $('#roundStartError').html(error.responseJSON.errors.round_start);
                        $('#roundEndError').html(error.responseJSON.errors.round_end);
                        $('#competitionError').html(error.responseJSON.errors.competition);
                        $('#descriptionError').html(error.responseJSON.errors.description);
                        $('#questionsNumberError').html(error.responseJSON.errors.questions_number);
                        $('#correctPointError').html(error.responseJSON.errors.correct_point);
                        $('#wrongPointError').html(error.responseJSON.errors.wrong_point);
                        $('#blankPointError').html(error.responseJSON.errors.blank_point);
                    }
                }
            });

        });

        //Edit button code
        $('body').on('click', '.editButton', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '{{url("rounds", '')}}' + '/' + id + '/edit',
                method: 'GET',
                success: function (response) {
                    $('.roundModel').modal('show');
                    $('#RoundTitle').html('Forduló szerkesztése');

                    $('#round_edit').val(response.id);
                    $('#round_name').val(response.round_name);
                    $('#round_start').val(response.round_start);
                    $('#round_end').val(response.round_end);
                    $('#questions_number').val(response.questions_number);
                    $('#description').val(response.description);
                    $('#correct_point').val(response.correct_point);
                    $('#wrong_point').val(response.wrong_point);
                    $('#blank_point').val(response.blank_point);
                    $('#competition').val(response.comp_name.concat(' - ', response.comp_year));

                },
                error: function (error) {
                    console.log(error)
                }
            });
        });

        //Delete button code
        $('body').on('click', '.deleteButton', function () {
            var id = $(this).data('id');
            if (confirm("Biztos hogy törölni akarod?")) {

                $.ajax({
                    url: '{{url("rounds", '')}}' + '/' + id + '/delete',
                    method: 'DELETE',
                    success: function (response) {
                        table.draw();
                        swal("Sikeres törlés!", response.success, "success");
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        });

        //Before new round the default values are restored
        $('#addRound').click(function () {
            $('#round_edit').val(null);
            $('#round_name').val('');
            $('#round_start').val('');
            $('#round_end').val('');
            $('#prize').val(10000);
            $('#description').val('');
            $('#address').val('');
            $('#round_limit').val(100);
            $('#entry_fee').val(0);
            $('#languages').val('');
            $('.roundModel').modal('hide');
            $('#RoundTitle').html('Verseny felvétele');
            $('#round_edit').val(null);

            $('.error-msg').html('');
        });

        $('#competitionSelect').change(function () {
            let comp_name = this.value.split(' - ')[0];
            let comp_year = this.value.split(' - ')[1];
            if (this.value === 'all') {
                table.search('').columns().search('').draw();
            } else {
                table.column(2).search(comp_name).draw();
                table.column(3).search(comp_year).draw();
            }
        })
    });
</script>
@endsection