@include('inc.home.head', ['title' => trans('Chat')])

<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('chat') }}" class="text-primary">{{trans('main.Chat')}}</a>
    </div>
</section>
    <section class="section">
        <div class="container">
            @if (count($chats) > 0)
                <h5 class="text-center my-4">{{trans('main.Chat')}}</h5>
            @endif
            @if (count($chats) > 0)
            <div class="row">
                @foreach($chats as $chat)
                    {{$chat}}
                @endforeach
            </div>
            @else
                <div class="empty-box">
                    {{trans('main.No Messeges Yet')}}
                </div>
            @endif
        </div>
    </section>

    @include('inc.home.foot')
    @include('inc.home.scripts')
</body>
</html>