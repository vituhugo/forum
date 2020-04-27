@extends('layouts.module')

@section('main')
    <section class="pb-5 py-3">
        <!-- Modulos -->

        <section class="duvidas pb-5">

            <h2 class="text-primary text-uppercase pl-3">Dúvidas</h2>

            <div class="card">
                <table class="table table-hover mb-0">
                    <thead class="bg-secondary text-white-50 ">
                        <tr class="row no-gutters">
                            <th class="col-8 py-1 pl-3">Assunto</th>
                            <th class="col-2 py-1">Estatísticas</th>
                            <th class="col-2 py-1">Última atividade</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($module->subjects as $subject)
                        <tr class="row no-gutters" data-href="{{ route('subject.show', [$module, $subject]) }}">
                            <td class="col-8">
                                <div class="row no-gutters flex-nowrap">
                                    <div class="col-auto pl-3">
                                        <i class="ti-folder text-secondary" style="font-size: 300%"></i>
                                    </div>
                                    <div class="col-auto flex-grow-1 px-2 m-auto" style="max-width: calc(100% - 60px) ">
                                        <h4 class="text-secondary m-0">
                                            {{ $subject->name }}
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="col-2">
                                <b class="text-secondary">
                                    {{ $subject->issues()->count() }} tópico(s)
                                    <br>
                                    {{ $subject->countAnswers() }} publicações(s)
                                </b>
                            </td>
                            <td class="col-2">
                                {{ ($subject->last_updated_issue ? $subject->last_updated_issue : $subject)->updated_at->format('d \\d\\e  F') }}, por:
                                <br>
                                @if ($subject->last_updated_issue)
                                    <a class="text-overflow-hidden d-inline-block" href="{{ route('profile.show', [$subject->last_updated_issue->last_user_updated]) }}">{{ $subject->last_updated_issue->last_user_updated->name }}</a>
                                @else
                                    Admin
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="align-middle pl-3">
                                <i class="ti-folder align-bottom mr-2" style="font-size: 2em"></i>
                                Nenhum item encontrado
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="section-articles pb-5">
            <h2 class="text-primary text-uppercase pl-3">Artigos Úteis</h2>

            <div class="card">
                <table class="table mb-0">
                    <thead class="bg-secondary text-white-50 ">
                    <tr>
                        <th scope="col" class="py-1 pl-3">Título</th>
                        <th scope="col" class="py-1">Estatísticas</th>
                        <th scope="col" class="py-1">Públicado por</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <th class="align-middle pl-3">
                                <h4>
                                    <i class="ti-file align-middle mr-2" style="font-size: 1.2em"></i>
                                    {{ $article->title }}
                                </h4>
                            </th>
                            <td style="width: 70px">
                                <b class="text-secondary">
                                    85 visualizações
                                    <br>
                                    5 gostaram
                                </b>
                            </td>
                            <td style="width: 160px">
                                <a href="#">Victor Rodrigues</a>
                                <br>
                                em 18 de fevereiro.
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="align-middle pl-3">
                                <i class="ti-file align-bottom mr-2" style="font-size: 2em"></i>
                                Nenhum artigo encontrado
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <h2 class="text-secondary text-uppercase px-3">Últimos eventos</h2>

        <div class="user-warnings">
            <div class="px-1">
                <div class="card" style="border-top-left-radius: 0;border-top-right-radius: 0" data-href="#">
                    <div class="card-header bg-primary text-white-50 py-1">
                        <i class="ti-file" style="font-size: .9em;margin-left: -1em;"></i> <b>Artigo</b> criado!
                        <span class="badge badge-primary float-right"><i class="ti-announcement text-white-50" style="font-size: 1.4em"></i></span>
                    </div>
                    <div class="card-body">
                        <p class="card-title font-weight-bold text-secondary">
                            industry's standard dummy
                        </p>
                        <p class="card-text mb-0">
                            <img style="border-radius: 100%;border: 1px solid gray;" src="https://www.kindpng.com/picc/b/303/3034310.png" width="40px" />
                            By <a href="#"><b>UserName</b></a>
                        </p>
                        <p class="card-text">
                            orem Ipsum has been the industry's standard dummy text ever since the 1500s...
                            <br>
                            <span class="badge badge-danger">Laravel</span>
                            <span class="badge badge-primary">Outros</span>
                            <span><small> 6 horas atrás</small></span>
                        </p>
                        <a class="font-weight-bold" href="#">Ir para o artigo...</a>
                    </div>
                </div>
            </div>
            <div class="px-1">
                <div class="card" style="border-top-left-radius: 0;border-top-right-radius: 0" data-href="#">
                    <div class="card-header bg-primary text-white-50 py-1">
                        <i class="ti-comments" style="font-size: .9em;margin-left: -1em;"></i> <b>Resposta</b> nova!
                    </div>
                    <div class="card-body">
                        <p class="card-title font-weight-bold text-secondary">
                            industry's standard dummy
                        </p>
                        <p class="card-text mb-0">
                            <img style="border-radius: 100%;border: 1px solid gray;" src="https://www.kindpng.com/picc/b/303/3034310.png" width="40px" />
                            By <a href="#"><b>UserName</b></a>
                        </p>
                        <p class="card-text">
                            orem Ipsum has been the industry's standard dummy text ever since the 1500s...
                            <br>
                            <span class="badge badge-danger">Laravel</span>
                            <span class="badge badge-primary">Outros</span>
                            <span><small> 6 horas atrás</small></span>
                        </p>
                        <a class="font-weight-bold" href="#">visualizar resposta...</a>
                    </div>
                </div>
            </div>

            <div class="px-1">
                <div class="card" style="border-top-left-radius: 0;border-top-right-radius: 0" data-href="#">
                    <div class="card-header bg-primary text-white-50 py-1">
                        <i class="ti-comment" style="font-size: .9em;margin-left: -1em;"></i> <b>Dúvida</b> nova!
                    </div>
                    <div class="card-body">
                        <p class="card-title font-weight-bold text-secondary">
                            industry's standard dummy
                        </p>
                        <p class="card-text mb-0">
                            <img style="border-radius: 100%;border: 1px solid gray;" src="https://www.kindpng.com/picc/b/303/3034310.png" width="40px" />
                            By <a href="#"><b>UserName</b></a>
                        </p>
                        <p class="card-text">
                            orem Ipsum has been the industry's standard dummy text ever since the 1500s...
                            <br>
                            <span class="badge badge-danger">Laravel</span>
                            <span class="badge badge-primary">Outros</span>
                            <span><small> 6 horas atrás</small></span>
                        </p>
                        <a class="font-weight-bold" href="#">Ir para a dúvida...</a>
                    </div>
                </div>
            </div>
            <div class="px-1">
                <div class="card" style="border-top-left-radius: 0;border-top-right-radius: 0" data-href="#">
                    <div class="card-header bg-primary text-white-50 py-1">
                        <i class="ti-user" style="font-size: .9em;margin-left: -1em;"></i> <b>Usuário</b> promovido!
                    </div>
                    <div class="card-body">
                        <p class="card-title font-weight-bold text-secondary">
                            industry's standard dummy
                        </p>
                        <p class="card-text mb-0">
                            <img style="border-radius: 100%;border: 1px solid gray;" src="https://www.kindpng.com/picc/b/303/3034310.png" width="40px" />
                            By <a href="#"><b>UserName</b></a>
                        </p>
                        <p class="card-text">
                            orem Ipsum has been the industry's standard dummy text ever since the 1500s...
                            <br>
                            <span class="badge badge-danger">Laravel</span>
                            <span class="badge badge-primary">Outros</span>
                            <span><small> 6 horas atrás</small></span>
                        </p>
                        <a class="font-weight-bold" href="#">ver perfil...</a>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection
