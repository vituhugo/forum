@extends('layouts.app', ['banner' => true])

@section('content')

    <div class="banner-home banner-animate {{ $random_gradient_class }}">
        <div class="container">
            <h1 class="text-white py-5 my-4" style="font-size: 3.5em"><b>Falando sobre {{ $module->name }}</b></h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <main class="col-12 px-0">
                <div class="container">
                    <ul class="breadcrumb mt-3">
                        <li class="breadcrumb-item">
                            <div class="btn-group dropright">
                                <button type="button" class="btn btn-link p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ strtoupper($module->name) }}
                                </button>
                                <div class="dropdown-menu">
                                    @foreach($modules as $mod)
                                        <a class="dropdown-item @if($mod->id === $module->id) active @endif" href="{{ route('module.show', [$mod->slug]) }}">{{ strtoupper($mod->name) }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="breadcrumb-item">Central de Dúvidas</li>
                    </ul>

                    @yield('main')
                </div>

            </main>
        </div>
    </div>

@endsection
