@extends('layouts.profile')

@section('main')
    <div class="card-header bg-gradient-soft">
        <div class="card-title">
            <h2 class="text-white">Dúvidas Abertass</h2>
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
                <h4>Você ainda não tem dúvidas abertas. Se quiser abrir uma nova dúvida, vá para a <a href="{{ route('module.index') }}"> Central de dúvidas </a> </h4>
            </li>
        @endforelse
    </ul>
@endsection
