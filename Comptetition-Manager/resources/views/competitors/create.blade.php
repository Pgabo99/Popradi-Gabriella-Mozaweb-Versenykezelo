@extends("layouts.default")
@section("title", "Versenyzők")
@section("content")
<main class="mt-5">
    <div class="container">
        <!-- Modal for the Creating and Editing-->
        <div class="modal fade competitorModel" id="Competitor" tabindex="-1" aria-labelledby="CompetitorTitle"
            aria-hidden="true">
            <form id="competitorForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="CompetitorTitle"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="comp_edit" class="form-control" name="comp_edit">

                            <!-- Competitor end -->
                            <div class="form-group mb-3">
                                <label for="user_email" class="form-label">Versenyző Email címe</label>
                                <select class="form-control" id="user_email" name="user_email">
                                    @foreach ($users as $user)
                                        <option value="{{$user->email}}">{{$user->email}}</option>

                                    @endforeach
                                </select>
                                <span id="userEmailError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Round id-->
                            <div class="form-group mb-3">
                                <label for="round_id" class="form-label">Forduló</label>
                                <select class="form-control" id="round_id" name="round_id">
                                    @foreach ($rounds as $round)
                                        <option value="{{$round->id}}">
                                            {{$round->comp_name . ' - ' . $round->comp_year . ' - ' . $round->round_name}}
                                        </option>

                                    @endforeach
                                </select>
                                <span id="roundIdError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Point-->
                            <div class="form-group mb-3">
                                <label for="points" class="form-label">Pontok</label>
                                <input type="number" min="0" value="0" id="points" class="form-control" name="points"
                                    required>
                                <span id="pointsError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Placement answer-->
                            <div class="form-group mb-3">
                                <label for="placement" class="form-label">Helyezés</label>
                                <input type="number" min="0" value="0" id="placement" class="form-control"
                                    name="placement" required>
                                <span id="placementError" class="text-danger error-msg"></span>
                            </div>


                            <!-- Right answer-->
                            <div class="form-group mb-3">
                                <label for="correct_answ" class="form-label">Helyes válaszok</label>
                                <input type="number" min="0" value="0" id="correct_answ" class="form-control"
                                    name="correct_answ" required>
                                <span id="correctAnswError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Wrong answer-->
                            <div class="form-group mb-3">
                                <label for="wrong_answ" class="form-label">Helytelen válaszok</label>
                                <input type="number" min="0" value="0" id="wrong_answ" class="form-control"
                                    name="wrong_answ" required>
                                <span id="wrongAnswError" class="text-danger error-msg"></span>
                            </div>


                            <!-- Blank answer-->
                            <div class="form-group mb-3">
                                <label for="blank_answ" class="form-label">Üresen hagyott kérdések</label>
                                <input type="number" min="0" value="0" id="blank_answ" class="form-control"
                                    name="blank_answ" required>
                                <span id="blankAnswError" class="text-danger error-msg"></span>
                            </div>

                        </div>

                        <!-- Close and Save Buttons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                            <button type="button" class="btn btn-primary" id="compSaveBTn">Mentés</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">

                <!-- New competitor modal trigger button -->
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Competitor"
                        id="addCompetitor" width="100%">Versenyző nevezése </button>
                </div>

                <!--Selection between avalaible rounds -->
                <select class="form-control" id="roundSelect" name="roundSelect">
                    <option value="all" selected>Forduló szűrése...</option>
                    @foreach ($rounds as $round)
                        <option value="{{$round->id}}">
                            {{$round->comp_name . ' - ' . $round->comp_year . ' - ' . $round->round_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Competitors table-->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle caption-bottom table-bordered"
                        id="competitors-table">
                        <thead class="table-light align-middle">
                            <tr>
                                <th colspan="8" style="text-align: center;">Versenyzők eredményei</th>
                            </tr>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Verseny</th>
                                <th scope="col">Pont</th>
                                <th scope="col">Helyezés</th>
                                <th scope="col" colspan="3">Válaszok <br> Helyes/Rossz/Üres</th>
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

        //Binding data for the Competitors Table
        var table = $('#competitors-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('competitors.index')}}",
            columns: [
                { data: 'user_email' },
                { data: 'round_id' },
                { data: 'points' },
                { data: 'placement' },
                { data: 'correct_answ' },
                { data: 'wrong_answ' },
                { data: 'blank_answ' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });

        // Deleting the error messages
        $('.error-msg').html('');

        //Saving/Updating data
        var form = $('#competitorForm')[0];
        $('#compSaveBTn').click(function () {

            //Disabling the save button during action
            $('compSaveBTn').attr('disabled', true);
            $('compSaveBTn').html('Folyamatban...');

            var formData = new FormData(form);

            // Saving the datas
            $.ajax({
                url: '{{route("competitors.store")}}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    table.draw();
                    $('.competitorModel').modal('hide');
                    $('compSaveBTn').attr('disabled', false);
                    $('compSaveBTn').html('Mentés');
                    $('.error-msg').html('');
                    if (response) {
                        swal("Sikeres mentés!", response.success, "success");
                        console.log(response);
                    }
                },
                error: function (error) {
                    if (error) {
                        $('#userEmailError').html(error.responseJSON.errors.user_email);
                        $('#roundIdError').html(error.responseJSON.errors.round_id);
                        $('#pointsError').html(error.responseJSON.errors.points);
                        $('#placementError').html(error.responseJSON.errors.placement);
                        $('#correctAnswError').html(error.responseJSON.errors.correct_answ);
                        $('#wrongAnswError').html(error.responseJSON.errors.wrong_answ);
                        $('#blankAnswError').html(error.responseJSON.errors.blank_answ);
                    }
                }
            });

        });

        //Edit button code
        $('body').on('click', '.editButton', function () {
            var user_email = $(this).data('user_email');
            var round_id = $(this).data('round_id');
            $.ajax({
                url: '{{url("competitors", '')}}' + '/' + user_email + '/' + round_id + '/edit',
                method: 'GET',
                success: function (response) {
                    $('.competitorModel').modal('show');
                    $('#CompetitorTitle').html('Verseny módosítása');

                    $('#comp_edit').val('editing');
                    $('#comp_name').val(response.user_email).attr('readonly', '');
                    $('#comp_start').val(response.round_id).attr('readonly', '');
                    $('#points').val(response.points);
                    $('#placement').val(response.placement);
                    $('#correct_answ').val(response.correct_answ);
                    $('#wrong_answ').val(response.wrong_answ);
                    $('#blank_answ').val(response.blank_answ);

                },
                error: function (error) {
                    console.log(error)
                }
            });
        });

        //Delete button code
        $('body').on('click', '.deleteButton', function () {
            var user_email = $(this).data('user_email');
            var round_id = $(this).data('round_id');
            if (confirm("Biztos hogy törölni akarod?")) {

                $.ajax({
                    url: '{{url("competitors", '')}}' + '/' + user_email + '/' + round_id + '/delete',
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

        //Before new competitor the default values are restored
        $('#addCompetitor').click(function () {
            $('#comp_edit').val(null);
            $('#user_email').val('').removeAttr('readonly');
            $('#round_id').val('').removeAttr('readonly');
            $('#points').val(0);
            $('#placement').val(0);
            $('#correct_answ').val(0);
            $('#wrong_answ').val(0);
            $('#blank_answ').val(0);
            $('.competitorModel').modal('hide');
            $('#CompetitorTitle').html('Verseny felvétele');
            $('#comp_edit').val(null);

            $('.error-msg').html('');
        });

        // Round selection 
        $('#roundSelect').change(function () {
            if (this.value === 'all') {
                table.search('').columns().search('').draw();
            } else {
                table.column(1).search(this.value).draw();
            }
        });


    });
</script>
@endsection