@extends('brackets/admin-ui::admin.layout.master')

@section('title', trans('brackets/admin-auth::admin.login.title'))

@section('content')
<div class="container" id="app">
    <div class="row align-items-center justify-content-center auth">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-block">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="auth-header">
                            <h4 class="auth-title">INICIAR SESION</h4>
                        </div>
                        <div class="auth-body">
                            <div class="form-group">
                                <a href="{{ url('login/google') }}" class="btn btn-youtube btn-block"><i class="fa fa-google"></i>
                                    <strong>Iniciar con Google</strong>
                                </a>
                                @if($errors->any())
                                    <h6 style="color:red">{{ $errors->first() }}</h6>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
