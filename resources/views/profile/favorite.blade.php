@extends('layouts.profile')

@section('main')
    <h2 class="text-primary">Favoritos</h2>
    @foreach($issues as $issue)
        <a href="{{ route('issue.show', [$issue]) }}" style="color: inherit">
            <div class="card mb-3">
                <div class="card-header bg-gradient-soft">
                    <h4 class="text-white" style="opacity: .7;">{{ $issue->title }}</h4>
                </div>
                <div class="card-body">
                    <p>{{ substr($issue->content, 0, 230) }}... <span class="text-primary">Ver dúvida completa</span></p>
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
                        <li class="list-inline-item">
                            <span class="badge badge-primary">{{ $issue->subject->module->name }}</span>
                            <span class="badge badge-warning text-overflow-hidden d-inline-block align-middle" style="max-width: 10em;">{{ $issue->subject->name }}</span>
                            @if($issue->approve_answer_id)
                                <span class="badge badge-success text-overflow-hidden d-inline-block align-middle" style="max-width: 10em;" title="resolvido">
                                    <i class="ti-crown"></i>
                                </span>
                            @else
                                <span class="badge badge-info text-overflow-hidden d-inline-block align-middle" style="max-width: 10em;" title="em aberto">
                                    <i class="ti-face-sad"></i>
                                </span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </a>
    @endforeach
@endsection
