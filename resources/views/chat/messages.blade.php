{{--<a href="{{ request()->fullUrl() }}">Обновить чат</a>--}}

{{--<div class="row mt-3 mb-3">--}}
{{--    @foreach($chat->messages as $message)--}}
{{--        <div class="col-12 d-flex mb-3--}}
{{--        @if($message->type == 'in')--}}
{{--            justify-content-start--}}
{{--        @else--}}
{{--            justify-content-end--}}
{{--        @endif--}}
{{--        ">--}}
{{--            <div class="bg-white p-4 pt-3 pb-3 rounded-3">--}}
{{--                {{ $message->text }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--</div>--}}

@vite([
    'resources/js/app.js'
])

<div id="app">
    <chat-component data-chat-id="{{ $chat->id }}"></chat-component>
</div>

<style>
    textarea {
        width: 100% !important;
        max-width: 100% !important;
    }

    .message-left {
        box-shadow: -4px 3px 8px rgba(0,0,0,.2);
        border-top-left-radius: 0 !important;
    }
    .message-right {
        box-shadow: 4px 3px 8px rgba(0,0,0,.2);
        border-top-right-radius: 0 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.scrollTo(0, document.body.scrollHeight + 600);
        console.log('loaded');
    });
</script>
