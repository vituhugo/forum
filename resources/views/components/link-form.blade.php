<form action="{{ $action }}" method="post" class="d-inline {{ $class }}">
    @method($method ?? 'post')
    @csrf
    <button class="btn btn-link d-inline p-0 {{ $class }}">
        {{ $slot }}
    </button>
</form>
