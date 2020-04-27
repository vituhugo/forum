@extends('layouts.app')

@section('content')
    <div class="container">
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
        <form class="container-fluid" enctype="multipart/form-data" action="{{ route('issue.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title text-primary">
                        Nova Dúvida
                    </h2>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="text-secondary col-2 col-form-label font-weight-bold text-right">
                            Título
                        </label>
                        <div class="text-secondary col-10">
                            <input name="title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-secondary col-2 col-form-label font-weight-bold text-right">
                            Assunto
                        </label>
                        <div class="text-secondary col-10">
                            <select name="subject_id" class="form-control">
                                <option value="">Selecione um assunto...</option>
                                @foreach($modules as $module)
                                    <optgroup label="{{ $module->name }}">
                                        @foreach($module->subjects as $subject)
                                            <option value="{{ $subject->id }}" @if (request('subject') == $subject->slug) selected @endif>{{ $subject->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-secondary col-2 col-form-label font-weight-bold text-right">
                            Descrição
                        </label>
                        <div class="text-secondary col-10">
                            <textarea name="content" class="form-control markdown-editor"></textarea>
                        </div>
                    </div>
                    <hr class="row">
                    <h3 class="offset-2 pl-2 card-title text-primary">
                        Anexos
                    </h3>


                    <div class="form-group row">
                        <label class="text-secondary col-2 col-form-label font-weight-bold text-right">
                            Adicionar
                        </label>
                        <div class="text-secondary col-10">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fle-attachment" id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Adicionar um anexo</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <fieldset class="offset-2" style="min-height: 65px">
                        <div class="row attachment-container">

                        </div>
                    </fieldset>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit"><i class="ti-plus"></i> Publicar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        new SimpleMDE({
            element: document.querySelector('textarea'),
            forceSync: true,
            toolbar: ["bold", "italic", "heading", "|","code", "quote", "unordered-list", "ordered-list", "|","preview", "fullscreen","guide"]

        });

        $('#fle-attachment').change(e => {
            let $container = $('.attachment-container')
            let file = e.target.files[0];

            $container.append(`
                <div class="col-4">
                    <div class="alert p-2 alert-info alert-dismissible fade show" role="alert">
                        <div class="row">
                            <input type="file" id="${file.name}" name="attachments[]" style="display: none" value="${e.target.value}">
                            <div class="col-auto pr-1 pt-1">
                                <i class="ti-file" style="font-size: 2.5em"></i>
                            </div>
                            <div class="col-auto pl-1 flex-grow-1">
                                <p class="m-0 pt-2" style="line-height: 1.2">
                                    <b>${file.name}</b>
                                    <i class="d-block">${Math.floor(file.size/100)/10} KB</i>
                                </p>

                                <button type="button" class="close col-auto" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            let new_file = document.getElementById(file.name).files = e.target.files;

            this.blur();
        })
    </script>
@endpush
