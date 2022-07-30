<div class="row">
    <div class="col-12">
        <a href="{{url('')}}" class="btn btn-link text-dark float-left">
            <i class="fas fa-home"></i>
        </a>
        /
        <a href="{{url( $redirect )}}" class="btn btn-link">{{ $message }}</a>/

        <span class="float-right mt-1">{{$slot}}</span>

    </div>
</div>
