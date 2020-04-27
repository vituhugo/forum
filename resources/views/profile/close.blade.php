@extends('layouts.profile')

@section('main')
    <div class="card-header bg-gradient-soft">
        <div class="card-title">
            <h2 class="text-white">Dúvidas Respondidas</h2>
        </div>
    </div>
    <ul class="list-group">
        @forelse($issues as $issue)
            <li class="list-group-item">
                <a href="#" style="color: inherit">
                    <h4 class="text-primary">{{ $issue->title }}</h4>
                    <p>{{ substr($issue->content, 0, 230) }}...</p>
                    <ul class="list-inline">
                        <li class="list-inline-item text-black-50">
                            criado {{ $issue->created_at->diffForHumans() }}
                            por <a href="{{ route('profile.show', [$issue->last_user_updated]) }}">{{ $issue->last_user_updated->name }}</a>
                        </li>
                        @if ($issue->updated_at != $issue->created_at)
                            <li class="list-inline-item text-black-50">
                                atualizado {{ $issue->updated_at->diffForHumans() }}
                                por <a href="{{ route('profile.show', [$issue->last_user_updated]) }}">{{ $issue->last_user_updated->name }}</a>
                            </li>
                        @endif
                        <li class="list-inline-item text-black-50">
                            {{ $issue->answers_count ?: 'ainda sem' }} resposta{{ $issue->answers_count != 1 ? 's' : '' }}
                        </li>
                    </ul>

                </a>

            </li>
            <li class="list-group-item">
                <h4 class="text-primary">{{ $issue->title }}</h4>
                <p>{{ substr($issue->content, 0, 230) }}...</p>
            </li>
        @empty
            <li class="list-group-item py-5">
                @if(auth()->user()->open_issues()->count() == 0)
                    <h4 class="mb-3">Você ainda não tem dúvidas abertas para serem respondidas, acesse a <a href="{{ route('module.index') }}">Central&nbsp;de&nbsp;dúvidas</a> para cria-las. </h4>
                @else
                    <h4 class="mb-3">Você ainda não tem nenhuma dúvida Respondida. </h4>
                    <h4>Se você está esperando uma dúvida sua ser respondida, você pode revisa-las em <a href="{{ route('profile.open') }}">Dúvidas abertas</a> </h4>
                @endif

            </li>
        @endforelse
    </ul>
@endsection
