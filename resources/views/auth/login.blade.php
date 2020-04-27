@extends('layouts.app')

@section('content')
    <div class="position-fixed fixed-top fixed-bottom bg-gradient-soft-reverse">
        <div class="d-flex align-items-center justify-content-center" style="min-height: 100%">
            <div class="container step-1">
                <div class="row">
                    <div class="col-6 offset-3 mb-5">
                        <h1 class="text-white text-center"> login.</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-4 bg-transparent border-white text-white" style="font-size: 1.5em">
                        <form class="pb-5" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleDropdownFormEmail1">Email</label>
                                <input type="email" name="email" class="form-control bg-transparent text-white" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleDropdownFormPassword1">Senha</label>
                                <input name="password" type="password" class="form-control bg-transparent text-white" id="exampleDropdownFormPassword1" placeholder="Digita sua senha...">
                            </div>
                            <div class="form-check pb-3" style="font-size: .75em">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <input name="remember" type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">
                                            Lembrar-me
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        |
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn-link text-white" href="#" style="font-size: .9em">Esqueceu sua senha?</a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-right">

                                <button type="submit" class="btn btn-outline-light btn-block">Entrar</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container step-2" style="display: none" >
                <div class="row">
                    <h1 class="text-white col-12 text-center">
                        Obrigado! <br>
                        Agora você será redirecionado para o nosso forum. Lá você poderá responder e fazer perguntas,
                        discutir com seus colegas e professores sobre o tema escolhido.<br/><br />
                        Ah, e fique tranquilo a qualquer momento você pode mudar o tema clicando no menu roxo na parte superior!
                    </h1>

                    <div class="col-12 pt-5">
                        <div class="text-center">
                            <button
                                form="frm-module"
                                style="font-size: 1.85em" class="btn btn-light text-secondary px-5"
                            >Prosseguir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
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
