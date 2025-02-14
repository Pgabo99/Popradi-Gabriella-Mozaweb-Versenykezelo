@extends("layouts.default")
@section("title", "Regisztráció")
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

                <!--Registration card -->
                <div class="card">
                    <h3 class="card-header text-center">Regisztráció</h3>
                    <div class="card-body">
                        <form method="POST" action="{{route("register.post")}}">
                            @csrf

                            <!--Last name -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Vezetéknév" id="last_name" class="form-control"
                                    name="last_name" required autofocus>
                                @if($errors->has('last_name'))
                                    <span class="text-danger">{{$errors->first('last_name')}}</span>
                                @endif
                            </div>

                            <!--First name -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Keresztnév" id="first_name" class="form-control"
                                    name="first_name" required>
                                @if($errors->has('first_name'))
                                    <span class="text-danger">{{$errors->first('first_name')}}</span>
                                @endif
                            </div>

                            <!--Username -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Felhasználónév" id="username" class="form-control"
                                    name="username">
                                @if($errors->has('username'))
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                @endif
                            </div>

                            <!--Email -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email"
                                    required>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>

                            <!--Password -->
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Jelszó" id="password" class="form-control"
                                    name="password" required>
                                @if($errors->has('password'))
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                @endif
                            </div>

                            <!--Password again -->
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Jelszó mégegyszer" id="password_again"
                                    class="form-control" name="password_again" required>
                                @if($errors->has('password_again'))
                                    <span class="text-danger">{{$errors->first('password_again')}}</span>
                                @endif
                            </div>

                            <!--Birth date -->
                            <div class="form-group mb-3">
                                <label for="birth_date" class="form-label">Születési idő</label>
                                <input type="date" value="2000-01-01" min="1900-01-01" max="<?= date('Y-m-d'); ?>"
                                    id="birth_date" class="form-control" name="birth_date" required>
                                @if($errors->has('birth_date'))
                                    <span class="text-danger">{{$errors->first('birth_date')}}</span>
                                @endif
                            </div>

                            <!--Adderess -->
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Lakcím" id="address" class="form-control"
                                    name="address">
                                @if($errors->has('address'))
                                    <span class="text-danger">{{$errors->first('address')}}</span>
                                @endif
                            </div>

                            <!--Registration submit button-->
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btnk-block">Regisztráció</button>
                            </div>

                            <!--Link for redirecting to the Login page-->
                            <div class="d-grid mx-auto justify-content-center">
                                <p>Van már felhasználód?<a href="{{route("login")}}"
                                        class="link-primary">Bejelentkezés</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection