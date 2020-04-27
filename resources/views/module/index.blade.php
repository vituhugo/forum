@extends('layouts.app')
@section('content')
    <div class="position-fixed fixed-top fixed-bottom" style="background: rgb(203,30,64);background: linear-gradient(22deg, rgba(203,30,64,1) 2%, rgba(109,30,69,1) 24%, rgba(76,30,71,1) 40%, rgba(40,30,73,1) 69%, rgba(76,30,71,1) 94%);">

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
        <div class="d-flex align-items-center justify-content-center" style="min-height: 100%">
            <div class="container step-1">
                <div class="row">
                    <h1 class="text-white col-12 text-center">
                        Olá, é sua primeira vez por aqui? <br>
                        Qual o assunto que você tem maior interesse nesse momento?
                    </h1>
                </div>
                <div class="row pt-3 step">
                    <div class="col-6 offset-3">
                        <form action="{{ route('module.change') }}" class="row justify-content-center" id="frm-module">
                            <input type="hidden" name="module" value="" id="hd-module">
                            @foreach($modules as $module)
                                <div class="col-4 py-2">
                                    <button
                                        style="font-size: 1.7em" class="btn btn-block btn-outline-light btn-module"
                                        type="button"
                                        onclick="document.getElementById('hd-module').value = '{{ $module->slug }}'"
                                    >{{ $module->name }}</button>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
            <div class="container step-2" style="display: none" >
                <div class="row">
                    <h1 class="text-white col-12 text-center">
                        Obrigado! <br>
                        Agora você será redirecionado para o nosso forum. Lá você poderá responder e fazer perguntas,
                        discutir com seus colegas e professores sobre o tema escolhido.<br/><br />
                        Ah, e fique tranquilo a qualquer momento você pode mudar o tema clicando no menu roxo na parte superior!
                    </h1>

                    <div class="col-12 pt-5">
                        <div class="text-center">
                            <button
                                form="frm-module"
                                style="font-size: 1.85em" class="btn btn-light text-secondary px-5"
                            >Prosseguir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.btn-module').click((e) => {
            $('.step-1').fadeOut(400, function () {
                $('.step-2').fadeIn(400);
            });
        })
    </script>
@endpush
