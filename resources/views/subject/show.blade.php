@extends('layouts.subject')

@section('main')
    <section class="pb-5 py-3">
        <!-- Modulos -->
        <h4 class="pl-3 text-primary text-uppercase">
            Dúvidas

            @if (auth()->user())
                <a href="{{ route('issue.create', compact('subject')) }}" class="btn py-0 float-right btn-primary">+ Nova Dúvida</a>
            @endif
        </h4>
        <div class="card">
            <table class="table table-hover mb-0">
                <thead class="bg-secondary text-white-50 ">
                <tr class="row no-gutters flex-nowrap">
                    <th class="col-8 py-1 pl-3">Título</th>
                    <th class="col-2 py-1">Estatísticas</th>
                    <th class="col-2 py-1">Última atividade</th>
                </tr>
                </thead>
                <tbody>
                @forelse($subject->issues as $issue)
                    <tr class="row no-gutters" data-href="{{ route('issue.show', [$issue]) }}">
                        <td class="col-8">
                            <div class="row no-gutters flex-nowrap">
                                <div class="col-auto pl-3">
                                    <i class="ti-file text-secondary" style="font-size: 300%"></i>
                                </div>
                                <div class="col-auto flex-grow-1 px-2 m-auto" style="max-width: calc(100% - 60px) ">
                                    <h4 class="text-secondary m-0">
                                        {{ $issue->title }}
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-2">
                            <b class="text-secondary">
                                {{ $issue->answers()->count() }} respostas(s)
                                <br>
                                {{ 1 }} interessado(s)
                            </b>
                        </td>
                        <td class="col-2">
                            {{ $issue->updated_at->format('d \\d\\e  F') }}, por:
                            <br>
                            <a href="{{ route('profile.show', [$issue->last_user_updated]) }}" class="text-overflow-hidden d-inline-block">{{ $issue->last_user_updated->name }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="align-middle pl-3">
                            <div class="row">
                                <div class="col-auto pr-0">
                                    <i class="ti-search" style="font-size: 200%"></i>
                                </div>
                                <div class="col-auto flex-grow-1">
                                    <h5 class="mb-0 mt-1">
                                        Não encontrou o que procurava? <a href="{{ route('issue.create', compact('subject')) }}">Clique aqui</a> e pergunte você mesmo.
                                    </h5>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <br>
        <!-- Artigos -->
        <h4 class="text-primary pl-3 text-uppercase">
            Artigos úteis
        </h4>
        <div class="card">
            <table class="table mb-0">
                <thead class="bg-secondary text-white-50 ">
                <tr>
                    <th scope="col" class="py-1 pl-3">Título</th>
                    <th scope="col" class="py-1">Estatísticas</th>
                    <th scope="col" class="py-1">Última atividade</th>
                </tr>
                </thead>
                <tbody>
{{--                    @forelse($modules as $mod)--}}
{{--                        <tr>--}}
{{--                            <th scope="row" class="align-middle pl-3"><h4><i class="ti-file align-middle mr-2" style="font-size: 1.2em"></i>Laravel</h4></th>--}}
{{--                            <td style="width: 70px">--}}
{{--                                <b class="text-secondary">--}}
{{--                                    25 tópicos--}}
{{--                                    <br>--}}
{{--                                    85 posts--}}
{{--                                </b>--}}
{{--                            </td>--}}
{{--                            <td style="width: 160px">--}}
{{--                                18 de fevereiro, por:--}}
{{--                                <br>--}}
{{--                                <a href="#">Victor Rodrigues</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
                    <tr>
                        <td scope="row" colspan="3" class="align-middle pl-3">
                            <i class="ti-folder align-bottom mr-2" style="font-size: 2em"></i>
                            Nenhum artigo encontrado
                        </td>
                    </tr>
{{--                    @endforelse--}}
                </tbody>
            </table>
        </div>
    </section>

@endsection
