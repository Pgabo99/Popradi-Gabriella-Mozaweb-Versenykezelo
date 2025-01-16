@extends("layouts.default")
@section("title", "Versenyek")
@section("content")
<main class="mt-5">
    <div class="container">
        <!-- Modal -->
        <div class="modal fade competitionModel" id="Competition" tabindex="-1" aria-labelledby="CompetitionTitle"
            aria-hidden="true">
            <form id="competitionForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="CompetitionTitle"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="comp_edit" class="form-control" name="comp_edit">

                            <!-- Competitions name -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Verseny neve" id="comp_name" class="form-control"
                                    name="comp_name" required autofocus>
                                <span id="compNameError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Competition start -->
                            <div class="form-group mb-3">
                                <label for="comp_start" class="form-label">Verseny kezdete</label>
                                <input type="date" min="<?= date('Y-m-d'); ?>" id="comp_start" class="form-control"
                                    name="comp_start" required>
                                <span id="compStartError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Competition end -->
                            <div class="form-group mb-3">
                                <label for="comp_end" class="form-label">Verseny vége</label>
                                <input type="date" min="<?= date('Y-m-d'); ?>" id="comp_end" class="form-control"
                                    name="comp_end" required>
                                <span id="compEndError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Prize-->
                            <div class="form-group mb-3">
                                <label for="prize" class="form-label">Nyeremény (Ft)</label>
                                <input type="number" id="prize" class="form-control" name="prize" min="0" value="10000"
                                    max="10000000" step="1000" required>
                                <span id="prizeError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Description-->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Leírás" id="description" class="form-control"
                                    name="description">
                                <span id="descriptionError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Address -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Helyszín" id="address" class="form-control"
                                    name="address" required>
                                <span id="addressError" class="text-danger error-msg"></span>
                            </div>


                            <!-- Languages-->
                            <div class="form-group mb-3">
                                <label for="languages" class="form-label">Elérhető nyelvek</label>
                                <select class="form-control" multiple id="languages" name="languages[]" multiple
                                    required>
                                    <option value="Magyar">Magyar</option>
                                    <option value="Angol">Angol</option>
                                    <option value="Német">Német</option>
                                    <option value="Francia">Francia</option>
                                    <option value="Olasz">Olasz</option>
                                </select>
                                <span id="languagesError" class="text-danger error-msg"></span>
                            </div>

                            <!-- Competition Limit-->
                            <div class="form-group mb-3">
                                <label for="comp_limit" class="form-label">Férőhely</label>
                                <input type="number" min="0" value="100" id="comp_limit" class="form-control"
                                    name="comp_limit" required>
                                <span id="compLimitError" class="text-danger error-msg"></span>

                            </div>

                            <!-- Entry fee-->
                            <div class="form-group mb-3">
                                <label for="entry_fee" class="form-label">Nevezési díj (Ft)</label>
                                <input type="number" min="0" value="0" max="100000" id="entry_fee" class="form-control"
                                    name="entry_fee" required>
                                <span id="entryFeeError" class="text-danger error-msg"></span>

                            </div>

                        </div>
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
                <!-- Button trigger modal -->
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Competition"
                        id="addCompetition" width="100%"> Új verseny </button>
                </div>

            </div>
            <!-- Rounds table-->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle caption-bottom table-bordered"
                        id="competitions-table">
                        <caption>Fordulók megtekintéséhez kattints egy sorra</caption>
                        <thead class="table-light align-middle">
                            <tr>
                                <th colspan="11" style="text-align: center;">Versenyek</th>
                            </tr>
                            <tr>
                                <th scope="col">Név</th>
                                <th scope="col">Év</th>
                                <th scope="col">Leírás</th>
                                <th scope="col">Helyszín</th>
                                <th scope="col">Mettől</th>
                                <th scope="col">Meddig</th>
                                <th scope="col">Nyelvek</th>
                                <th scope="col">Férőhely</th>
                                <th scope="col">Díj</th>
                                <th scope="col">Nevezési díj</th>
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

        var table = $('#competitions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('competitions.index')}}",
            columns: [
                { data: 'comp_name', className: "clickable" },
                { data: 'comp_year', className: "clickable" },
                { data: 'description', className: "clickable" },
                { data: 'address', className: "clickable" },
                { data: 'comp_start', className: "clickable" },
                { data: 'comp_end', className: "clickable" },
                { data: 'languages', className: "clickable" },
                { data: 'comp_limit', className: "clickable" },
                { data: 'prize', className: "clickable" },
                { data: 'entry_fee', className: "clickable" },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });

        $('.error-msg').html('');

        //Saving/Updating data
        var form = $('#competitionForm')[0];
        $('#compSaveBTn').click(function () {

            $('compSaveBTn').attr('disabled', true);
            $('compSaveBTn').html('Folyamatban...');

            var formData = new FormData(form);
            $.ajax({
                url: '{{route("competitions.store")}}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    table.draw();
                    $('.competitionModel').modal('hide');
                    $('compSaveBTn').attr('disabled', false);
                    $('compSaveBTn').html('Mentés');
                    $('.error-msg').html('');
                    if (response) {
                        swal("Sikeres mentés!", response.success, "success");
                    }
                },
                error: function (error) {
                    if (error) {
                        $('#compNameError').html(error.responseJSON.errors.comp_name);
                        $('#compStartError').html(error.responseJSON.errors.comp_start);
                        $('#compEndError').html(error.responseJSON.errors.comp_end);
                        $('#prizeError').html(error.responseJSON.errors.prize);
                        $('#descriptionError').html(error.responseJSON.errors.description);
                        $('#addressError').html(error.responseJSON.errors.address);
                        $('#languagesError').html(error.responseJSON.errors.languages);
                        $('#compLimitError').html(error.responseJSON.errors.comp_limit);
                        $('#entryFeeError').html(error.responseJSON.errors.entry_fee);
                    }
                }
            });

        });

        //Edit button code
        $('body').on('click', '.editButton', function () {
            var comp_name = $(this).data('comp_name');
            var comp_year = $(this).data('comp_year');
            $.ajax({
                url: '{{url("competitions", '')}}' + '/' + comp_name + '/' + comp_year + '/edit',
                method: 'GET',
                success: function (response) {
                    $('.competitionModel').modal('show');
                    $('#CompetitionTitle').html('Verseny módosítása');

                    $('#comp_edit').val('editing');
                    $('#comp_name').val(response.comp_name).attr('readonly', '');
                    $('#comp_start').val(response.comp_start).attr('readonly', '');
                    $('#comp_end').val(response.comp_end);
                    $('#prize').val(response.prize);
                    $('#description').val(response.description);
                    $('#address').val(response.address);
                    $('#comp_limit').val(response.comp_limit);
                    $('#entry_fee').val(response.entry_fee);
                    $('#languages').val(response.languages.split(', '));

                },
                error: function (error) {
                    console.log(error)
                }
            });
        });

        //Delete button code
        $('body').on('click', '.deleteButton', function () {
            var comp_name = $(this).data('comp_name');
            var comp_year = $(this).data('comp_year');
            if (confirm("Biztos hogy törölni akarod?")) {

                $.ajax({
                    url: '{{url("competitions", '')}}' + '/' + comp_name + '/' + comp_year + '/delete',
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

        //Before new competition the default values are restored
        $('#addCompetition').click(function () {
            $('#comp_edit').val(null);
            $('#comp_name').val('').removeAttr('readonly');
            $('#comp_start').val('').removeAttr('readonly');
            $('#comp_end').val('');
            $('#prize').val(10000);
            $('#description').val('');
            $('#address').val('');
            $('#comp_limit').val(100);
            $('#entry_fee').val(0);
            $('#languages').val('');
            $('.competitionModel').modal('hide');
            $('#CompetitionTitle').html('Verseny felvétele');
            $('#comp_edit').val(null);

            $('.error-msg').html('');
        });

        //Click on a row
        $('#competitions-table tbody').on('click', 'td.clickable', function () {
            window.location.href = "{{ route('rounds.create')}}";

        });
    });
</script>
@endsection