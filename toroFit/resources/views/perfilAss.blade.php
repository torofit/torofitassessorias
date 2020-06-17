@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<div class="container">
    <br>
    <div class="create-tarifa-div">
        <a class="create-tarifa" href="/perfilAss/editor"><i class="fa fa-plus" aria-hidden="true"></i> Editar Perfil</a>
    </div>
    @if($user->assessor->perfilAssessors == null)
    <br>
    <h1 style="text-align: center">Perfil de {{$user->name}}</h1>
    <p>{{$user->assessor->description}}</p>
    @else
    <br>
    {!!$user->assessor->perfilAssessors->body!!}
    @endif
    <div class="etiquetes">
        <h3 style="text-align: center">Etiquetes</h3>
        <div class="etiquetes-flex">
            @foreach ($user->assessor->etiquetas as $et)
                <li class="etiqueta">{{$et->name}}</li>
            @endforeach
        </div>
    </div>
    <h3 style="text-align: center; margin-top:20px">Tarifes</h3>
    <div class="row justify-content-center">
        @if($user->assessor->tarifas == "[]")
        <h4 style="text-align: center; margin-top:40px">De moment no tens tarifes les pots crear des de el menu de tarifes</h6>
        @endif
        @foreach ($user->assessor->tarifas as $t)
        <div class="card" style="width: 18rem;">
            <h5 class="card-titol">{{$t->title}}</h5>
            <h6 class="card-duration">Duracio {{$t->duration}} mes<h6>
                    <h6 class="card-price">{{$t->price}}€</h6>
                    <div>

                        <p class="card-description">{{$t->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach (unserialize($t->caracteristiques) as $car)
                        @if($car != null)
                        <li class="list-group-item">{{$car}}</li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="margin-auto">
                            <button class="btn-con">Contractar Tarifa</button>
                    </div>


        </div>
        @endforeach
    </div>
</div>
@include('includes.footer')
@stop
<style>
.etiquetes-flex{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;

}
.etiqueta{
    margin-right: 40px; 
    margin-top: 20px;
}
</style>