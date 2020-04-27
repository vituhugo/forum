@extends('layouts.issue')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-header bg-gradient-soft">
                <h2 class="card-title text-white mb-0 px-3">
                    {{ $issue->title }}
                </h2>

                <div class="row text-white-50 px-3">
                    <span class="col-3">
                        <small>Perguntado </small>{{ $issue->created_at->diffForHumans() }}
                    </span>
                    <span class="col-3">
                        <small>Ultima atualização</small> {{ $issue->updated_at->diffForHumans() }}
                    </span>
                    <span class="col-3">
                        <small>Visualizações</small> {{ $issue->views }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1 d-flex flex-column pt-4" style="font-size: 1.5em">
                        @if (!auth()->user()->wasVoted($issue))
                            <x-link-form class="text-center" :action="route('issue.like', [$issue])">
                                <i class="ti-angle-double-up"></i>
                            </x-link-form>
                            <span class="text-center">{{ $issue->points }}</span>
                            <x-link-form class="text-center"  :action="route('issue.unlike', [$issue])">
                                <i class="ti-angle-double-down"></i>
                            </x-link-form>
                            @else
                            <span class="text-center text-black-50" style="font-size: .7em">
                                <i class="ti-angle-double-up"></i>
                            </span>

                            <span class="text-center">{{ $issue->points }}</span>

                            <span class="text-center text-black-50" style="font-size: .7em">
                                <i class="ti-angle-double-down"></i>
                            </span>
                        @endif
                    </div>
                    <div class="col-11">
                        {!! $issue->content !!}

                        <div class="row justify-content-between flex-nowrap mt-3 mb-0">
                            <div class="col-8">
                                @if (auth()->user() && $issue->user_id === auth()->user()->id)
                                    <a href="{{ route('issue.edit', [$issue]) }}" class="btn-link px-3">
                                        <i class="ti-pencil" style="font-size: .9em"></i> editar
                                    </a>
                                    <a href="#" class="btn-link px-3">
                                        <i class="ti-close" style="font-size: .8em"></i> fechar
                                    </a>
                                @else
                                    <x-link-form :action="route('issue.follow', [$issue])">
                                        <i class="ti-eye"></i>
                                        @if(auth()->user() && auth()->user()->isFollower($issue))
                                            <b>Seguindo</b>
                                        @else
                                            Seguir
                                        @endif
                                    </x-link-form>
                                    &nbsp;&nbsp;
                                    <x-link-form :action="route('issue.favorite', [$issue])">
                                        <i class="ti-star"></i>
                                        @if(auth()->user() && auth()->user()->isFavorite($issue))
                                            <b>Favorito</b>
                                        @else
                                            Favoritar
                                        @endif
                                    </x-link-form>
                                @endif
                            </div>
                            <div class="user-card p-2 mr-2 col-auto" style="background: #e9e3ff">
                                <div class="row">
                                    <div class="col-auto pr-0">
                                        <img src="{{ $issue->user->avatar_url }}" width="50" />
                                    </div>
                                    <div class="col-auto">
                                        <a href="#">{{ $issue->user->name }}</a><br>
                                        <span class="badge badge-primary">{{ $issue->user->position->name }}</span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-1 col-11">
                        <ul class="list-group list-group-flush px-2" style="font-size: .9em">
                            <li class="list-group-item px-3"></li>
                            @foreach($issue->comments as $comment)
                                <li class="list-group-item px-4 py-1">
                                    {{ $comment->content }} --
                                    <a href="{{ route('profile.show', [$comment->user]) }}">
                                        {{ $comment->user->name }}
                                    </a> <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    <div class="float-right">
                                        <form method="post" class="d-inline" action="{{ route('issue.comment_destroy', [$issue, $comment]) }}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn-link btn p-0">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                            <li class="list-group-item py-1 px-0">
                                <div class="row">
                                    <div class="btn-group col-12">
                                        <button class="btn btn-link text-left p-0" data-toggle="dropdown" >
                                            adicionar commentário
                                        </button>
                                        <form action="{{ route('issue.comment', [$issue]) }}" method="post" class="dropdown-menu bg-primary p-1" style="width: calc(100% - 30px)">
                                            @csrf
                                            <div class="row no-gutters">
                                                <div class="form-group mb-0 col-auto flex-grow-1">
                                                    <input type="text" name="content" class="form-control" id="exampleDropdownFormEmail2" placeholder="Escreva o seu comentário">
                                                </div>
                                                <div class="form-group mb-0 pl-1 col-auto">
                                                    <button type="submit" class="btn btn-outline-light">Comentar!</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-4">
                    <h4 class="card-title col-12">
                        {{ $issue->answers_count ?: 'Sem ' }} Resposta{{ in_array($issue->answers_count, [0,1]) ? '' : 's' }}
                    </h4>
                </div>

                @foreach($issue->answers as $answer)
                <div class="row">
                    <div class="col-1 d-flex flex-column" style="font-size: 1.5em">
                        <a href="#" class="btn-link px-3 text-center link-unstyled text-black-50" title="Essa pergunta demonstra esforço em pesquisa, é útil e clara.">
                            <i class="ti-angle-double-up"></i>
                        </a>
                        <span class="text-center">{{ $answer->rank ?? 0 }}</span>
                        <a href="#" class="btn-link px-3 text-center link-unstyled text-black-50" title="Essa pergunta não demonstra esforço de pesquisa, não está clara e não é útil">
                            <i class="ti-angle-double-down"></i>
                        </a>

                        @if($answer->id === $issue->approve_answer_id)
                        <div class="text-center">
                            <span class="badge badge-success" title="O responsável aprovou essa resposta como correta.">
                                <i class="ti-crown"></i>
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="col-11">
                        {!! $answer->content !!}

                        <div class="row justify-content-between flex-nowrap mt-3 mb-0">
                            <div class="col-8">
                                @if ($answer->user_id === auth()->user()->id)
                                    <a href="{{ route('answer.edit', [$issue, $answer]) }}" class="btn-link px-3">
                                        <i class="ti-pencil" style="font-size: .9em"></i> editar
                                    </a>
                                    <a href="#" class="btn-link px-3">
                                        <i class="ti-close" style="font-size: .8em"></i> excluir
                                    </a>
                                @else
                                    <a href="#" class="btn-link px-3">
                                        <i class="ti-crown" style="font-size: .8em"></i> Resolveu meu problema!
                                    </a>
                                @endif
                            </div>
                            <div class="user-card p-2 mr-2 col-auto">
                                <div class="row flex-column">
                                    <div class="col-auto">
                                        <div class="row">
                                            <div class="col-auto pr-0">
                                                <img src="{{ $answer->user->avatar_url }}" width="50" />
                                            </div>
                                            <div class="col-auto">
                                                <a href="#">{{ $answer->user->name }}</a><br>
                                                <span class="badge badge-primary">{{ $answer->user->position->name }}</span><br>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-black-50 mb-1 pl-3">
                                        Respondida {{ $answer->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-11 offset-1">
                        <ul class="list-group list-group-flush px-2" style="font-size: .9em">
                            <li class="list-group-item px-3"></li>
                            @foreach($answer->comments as $comment)
                            <li class="list-group-item px-4 py-1">
                                {{ $comment->content }} --
                                <a href="{{ route('profile.show', [$comment->user]) }}">
                                    {{ $comment->user->name }}
                                </a> <small>{{ $comment->created_at->diffForHumans() }}</small>
                                <div class="float-right">
                                    <form method="post" class="d-inline" action="{{ route('answer.comment_destroy', [$issue, $answer, $comment]) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn-link btn p-0">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                            <li class="list-group-item px-4 py-1">
                                <div class="row">
                                    <div class="btn-group col-12">
                                        <button class="btn btn-link text-left p-0" data-toggle="dropdown" >
                                            adicionar commentário
                                        </button>
                                        <form action="{{ route('answer.comment', [$issue, $answer]) }}" method="post" class="dropdown-menu bg-primary p-1" style="width: calc(100% - 30px)">
                                            @csrf
                                            <div class="row no-gutters">
                                                <div class="form-group mb-0 col-auto flex-grow-1">
                                                    <input type="text" name="content" class="form-control" id="exampleDropdownFormEmail2" placeholder="Escreva o seu comentário">
                                                </div>
                                                <div class="form-group mb-0 pl-1 col-auto">
                                                    <button type="submit" class="btn btn-outline-light">Comentar!</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach

                @if (auth()->user())
                    <hr>
                    <form class="row pt-2" action="{{ route('answer.store', [$issue]) }}" method="POST">
                        @csrf
                        <h4 class="card-title col-12">
                            Responda:
                        </h4>

                        <div class="form-group col-12 pt-2">
                            <textarea name="content" class="form-control"></textarea>
                            <p class="text-right">
                                <button class="btn btn-primary">Publicar resposta</button>
                            </p>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        new SimpleMDE({
            element: document.querySelector('textarea'),
            forceSync: true,
            toolbar: ["bold", "italic", "heading", "|","code", "quote", "unordered-list", "ordered-list", "|","preview", "fullscreen","guide"]

        });
    </script>
@endpush
