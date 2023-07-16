<a href="{{ request()->fullUrl() }}">Обновить чат</a>

<div class="row mt-3 mb-3">
    @foreach($chat->messages as $message)
        <div class="col-12 d-flex mb-3
        @if($message->type == 'in')
            justify-content-start
        @else
            justify-content-end
        @endif
        ">
            <div class="bg-white p-4 pt-3 pb-3 rounded-3">
                {{ $message->text }}
            </div>
        </div>
    @endforeach
</div>
