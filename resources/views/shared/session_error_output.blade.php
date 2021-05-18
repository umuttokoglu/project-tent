@if(session('result'))
    <ul class="list mt-3">
        @foreach(session('result')->getErrors() as $error)
            <li class="text-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
