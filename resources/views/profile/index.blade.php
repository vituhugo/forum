@extends('layouts.profile')

@section('main')
    <img class="card-img-top" src="https://picsum.photos/800/200" alt="Card image cap" style="margin-bottom: -140px;filter: brightness(50%)" width="800" height="200">
    <div class="card-body" style="z-index: 1;">
        <div class="">
            <div class="row">
                <div class="col-auto offset-1">
                    <img src="{{ Storage::disk('public')->url(auth()->user()->avatar) }}" class="avatar big" />
                </div>
                <div class="col-auto pt-4">
                    <h1 class="ml-2 mb-0 text-white">{{ auth()->user()->name }} </h1>
                    <h3 class="ml-2 text-primary">#Rank 13213 </h3>
                </div>
            </div>
        </div>
        <div class="user-data pt-4" style="margin-left: 5%">
            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold">
                    Email
                </label>
                <label class="col-10">
                    <input name="email" value="{{ auth()->user()->email }}" class="form-control-plaintext">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold">
                    Curso
                </label>
                <label class="col-10">
                    <input name="email" value="{{ auth()->user()->course ? auth()->user()->course->name : "Nenhum"  }}" class="form-control-plaintext">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold">
                    Cargo no forum
                </label>
                <label class="col-10">
                    <input name="email" value="{{ auth()->user()->position ? auth()->user()->position->name : "ADMIN" }}" class="form-control-plaintext">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold">
                    Data de inciação
                </label>
                <label class="col-10">
                    <input name="email" value="{{ auth()->user()->created_at->format('d/m/Y')  }}" class="form-control-plaintext">
                </label>
            </div>

            <div class="form-group row no-gutters">
                <label class="col-2 col-form-label font-weight-bold">
                    Status
                </label>
                <label class="col-10">
                    <input name="email" value="{{ auth()->user()->status ?? 'Ativo'  }}" class="form-control-plaintext">
                </label>
            </div>

            <hr>

            <div>
                <h2 class="card-title text-secondary"><i class="ti-medall align-bottom"></i> Medalhas</h2>
                @forelse(auth()->user()->awards as $award)

                @empty
                    <p class="pl-5 text-black-50" style="font-size: 1.4em">
                        Por enquanto você ainda não possui medalhas campeão.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
