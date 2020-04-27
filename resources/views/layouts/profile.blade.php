@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="px-5">
            <div class="row">
                <div class="col-3">
                    <div class="card text-right">
                        <div class="card-header bg-secondary">
                            <div class="row" style="font-size: .9em">
                                <div class="col-auto flex-grow-1 px-0 m-auto">
                                    <p class="mb-0 text-white text-overflow-hidden">{{ auth()->user()->name }} </p>
                                    <p class="text-primary mb-0">#Rank 13213 </p>
                                </div>
                                <div class="col-auto">
                                    <img class="avatar border-primary" src="{{ Storage::disk('public')->url(auth()->user()->avatar) }}" />
                                </div>
                            </div>

                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile') }}">
                                    Visualizar Perfil
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.edit') }}">
                                    Editar Perfil
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.password') }}">
                                    Alterar Senha
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.open') }}">
                                    <div class="row">
                                        <div class="col-2">
                                            <span class="badge badge-danger">{{ auth()->user()->open_issues()->count() }}</span>
                                        </div>
                                        <div class="col-10">
                                            Dúvidas Abertas
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.close') }}">
                                    <div class="row">
                                        <div class="col-2">
                                            <span class="badge badge-success">{{ auth()->user()->approve_issues()->count() }}</span>
                                        </div>
                                        <div class="col-10">
                                            Dúvidas Respondidas
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.favorite') }}">
                                    <div class="row">
                                        <div class="col-2">
                                            <span class="badge badge-secondary">{{ auth()->user()->favorite()->count() }}</span>
                                        </div>
                                        <div class="col-10">
                                            Favoritos
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="btn-link" href="{{ route('profile.history') }}">
                                    Histórico
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-9">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        @yield('main')
                </div>
            </div>
        </div>
    </div>
@endsection
