@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card border-0 bg-light px-4 py-2">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" name="email" class="form form-control border-0" placeholder="Tu nombre ...">
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña:</label>
                                <input type="password" value="password" name="password" class="form form-control border-0" placeholder="Tu contraseña ...">
                            </div>
                            <button id="login-btn" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
