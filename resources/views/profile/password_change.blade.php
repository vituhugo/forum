@extends('layouts.profile')

@section('main')

    <div class="card-header bg-gradient-soft">
        <h2 class="card-title text-white">
            Alterar Senha
        </h2>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.change_password') }}" method="post" >
            @csrf
            @method('put')
            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold text-secondary">
                    Senha
                </label>
                <label class="col-10">
                    <input class="form-control" name="old_password" placeholder="Digite sua senha atual...">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold text-secondary">
                    Nova senha
                </label>
                <label class="col-10">
                    <input class="form-control" name="password" placeholder="Digite a senha nova...">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold text-secondary">
                    Confirmar
                </label>
                <label class="col-10">
                    <input class="form-control" name="password_confirmation" placeholder="Confirme a senha nova...">
                </label>
            </div>

            <p class="text-right">
                <button type="submit" class="btn btn-primary">Alterar Senha</button>
            </p>
        </form>
    </div>
@endsection
