<div class="row mb-2">
    <div class="col-12">
        <small class="mr-1"><i class="fas fa-globe"></i></small>
        @foreach ($routes as $routeText => $routeName)
        <a href="{{$routeName}}" class="text-primary">
            {{$routeText}}
        </a>
        /   
        @endforeach
    </div>
</div>
