@extends('layouts.app', ['banner' => true])
@section('content')
    <div class="container">
        <div class="col-12">
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
                <li class="breadcrumb-item">
                    <a href="{{ route('subject.show', [$issue->subject->module, $issue->subject]) }}">
                        {{ $issue->subject->name }}
                    </a>
                </li>
                <li class="breadcrumb-item ellipsis active" title="{{ $issue->title }}">
                    {{ $issue->title }}
                </li>
            </ul>
        </div>

        @yield('main')
    </div>

@endsection
