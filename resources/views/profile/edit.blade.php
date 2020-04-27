@extends('layouts.profile')

@section('main')

    <div class="card-header bg-gradient-soft">
        <h2 class="card-title text-white">
            Editar Perfil
        </h2>
    </div>
    <div class="card-body">
        <div class="user-data pt-4">
            <form id="frm-profile" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group row no-gutters">
                    <label class="col-2 col-form-label font-weight-bold text-secondary">
                        Nome
                    </label>
                    <div class="col-10">
                        <input class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-2 col-form-label font-weight-bold text-secondary">
                        Email
                    </label>
                    <label class="col-10">
                        <input class="form-control" name="email" value="{{ auth()->user()->email }}">
                    </label>
                </div>

                <div class="form-group row no-gutters">
                    <label class="col-2 col-form-label font-weight-bold text-secondary">
                        Foto
                    </label>
                    <label class="col-10">
                        <input class="form-control-file" name="avatar" type="file">
                    </label>
                </div>

                <p class="text-right">
                    <button type="submit" class="btn btn-primary" form="frm-profile">Atualizar</button>
                </p>
            </form>
        </div>
    </div>
@endsection
