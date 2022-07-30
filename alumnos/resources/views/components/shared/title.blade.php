@section('header')
    <h4 class="text-center blue-text">{!! $title !!}</h4>
    @if ($subtitle)
    <div class="text-center">
        <hr style="margin: 5px 0px;">
        <small class="blue-text">{!! $subtitle !!}</small>
    </div>
    @endif
@endsection
