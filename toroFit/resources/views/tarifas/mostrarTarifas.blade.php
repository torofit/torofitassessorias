@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<div class="container">
    <h1 style="text-align: center; margin-top:20px">Les Meves Tarifes</h1>
    <div class="create-tarifa-div">
        <a class="create-tarifa" href="/tarifes/crearTarifa"><i class="fa fa-plus" aria-hidden="true"></i> Crear
            Tarifa</a>
    </div>
    <div class="row justify-content-center">  
        @if($tar == "[]")
        <h4 style="text-align: center; margin-top:40px">De moment no tens tarifes peró les pots crear amb el botó d'adalt</h6>
        @endif
        @foreach ($tar as $t)
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
                        <form action="/tarifes/editarTarifa/{{$t->id}}">
                            <button class="btn-con">Editar Tarifa</button>
                        </form>
                        <form id="delete-tar">
                            <input type="hidden" value="{{$t->id}}" id="form-id">
                            <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
                            <button type="submit" class="btn-del">Eliminar Tarifa</button>
                        </form>
                    </div>


        </div>
        @endforeach
    </div>

</div>
@include('includes.footer')
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
 $(document).ready(function () {

      $('.container #delete-tar button:submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
              type: "DELETE",
              url: "/tarifes/eliminarTarifa/"+$('#form-id').val(),
              data: {
                  "_token": $('#token-edit').val(),
              },
              success: function (response) {
                toastr.success(response.notification.message, "Success");
                $('#form-id').closest('.card').css('display', 'none')
                  
              },
              error: function (error) {
                  if (error.responseJSON.error == undefined) {
                      toastr.error("error", "Error")
                  } else {
                      toastr.error(error.responseJSON.error, "Error")
                  }
              }
          })
      })
  })

</script>