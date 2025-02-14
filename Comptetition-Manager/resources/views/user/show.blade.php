@extends("layouts.default")
@section("title", "Profilom")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <!-- Alert if everything was successfull -->
                @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{session()->get("success")}}
                    </div>
                @endif

                <!-- Alert if there was an error -->
                @if(session()->has("error"))
                    <div class="alert alert-error">
                        {{session()->get("error")}}
                    </div>
                @endif

                <!-- Profile card  -->
                <div class="card">
                    <h3 class="card-header text-center">Profilom</h3>
                    <div class="card-body">

                        <!-- Form based on the action () -->
                        @if($editing)
                            <form method="POST" action="{{route("user.update", $user)}}">
                                @csrf
                                @method('put')
                        @else
                            <form method="GET" action="{{route("user.edit", $user)}}">
                                @csrf
                        @endif

                                <!-- Last name -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Vezetéknév" id="last_name" class="form-control"
                                        name="last_name" value="{{$user->last_name}}" {{$editing ? 'required autofocus' : 'disabled'}}>
                                    @if($errors->has('last_name'))
                                        <span class="text-danger">{{$errors->first('last_name')}}</span>
                                    @endif
                                </div>

                                <!-- First name -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Keresztnév" id="first_name" class="form-control"
                                        name="first_name" value="{{$user->first_name}}" {{$editing ? 'required' : 'disabled'}}>
                                    @if($errors->has('first_name'))
                                        <span class="text-danger">{{$errors->first('first_name')}}</span>
                                    @endif
                                </div>

                                <!-- Username -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Felhasználónév" id="username" class="form-control"
                                        name="username" value="{{$user->username}}" {{$editing ? '' : 'disabled'}}>
                                    @if($errors->has('username'))
                                        <span class="text-danger">{{$errors->first('username')}}</span>
                                    @endif
                                </div>

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email"
                                        value="{{$user->email}}" {{$editing ? 'required' : 'disabled'}}>
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>

                                <!-- Birth date -->
                                <div class="form-group mb-3">
                                    <label for="birth_date" class="form-label">Születési idő</label>
                                    <input type="date" value="{{$user->birth_date}}" min="1900-01-01"
                                        max="<?= date('Y-m-d'); ?>" id="birth_date" class="form-control"
                                        name="birth_date" {{$editing ? 'required' : 'disabled'}}>
                                    @if($errors->has('birth_date'))
                                        <span class="text-danger">{{$errors->first('birth_date')}}</span>
                                    @endif
                                </div>

                                <!-- Address-->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Lakcím" id="address" class="form-control"
                                        name="address" value="{{$user->address}}" {{$editing ? '' : 'disabled'}}>
                                    @if($errors->has('address'))
                                        <span class="text-danger">{{$errors->first('address')}}</span>
                                    @endif
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mx-auto">
                                    <button type="submit"
                                        class="btn btn-dark btnk-block">{{$editing ? 'Mentés' : 'Szerkesztés'}}</button>
                                </div>
                            </form>

                            <br>

                            <!-- Delete button -->
                            <div class="d-grid mx-auto">
                                <a class="btn btn-danger" href="#"
                                    onclick="return confirmDelete('delete-form');">Törlés</a>
                                <form id="delete-form" action="{{ route('user.destroy', $user) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>

                            <!-- Back button, only avalaible during editing -->
                            @if($editing)
                                <br>
                                <div class="d-grid mx-auto">
                                    <a class="btn btn-dark" href="{{ url()->previous()}}">Mégse</a>
                                </div>

                            @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    //Confirmation before deleting the data
    function confirmDelete(formId) {
        if (confirm("Biztos, hogy törölni akarod?"))
            document.getElementById(formId).submit();
    }

</script>
@endsection