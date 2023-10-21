@extends('layouts.menu')

@section('head')
<link rel="stylesheet" href="{{ asset('css/absences.css') }}">
@endsection

@section('content')


  <div class="container-fluid">
    <div class="row">
      <!-- SideNav -->
      <div class="col-1-5 full-height bg-dark">
        <div class="row d-flex justify-content-center">
          <h1 class="text-light"><i class="bi bi-check2-all"></i> JustiFacil</h1>
        </div>
        <hr class="border-top">
        <div class="row">
          <h4 id="absences" class="text-light"><i class="bi bi-calendar-check-fill"></i> Ausencias</h4>
        </div>
        <hr class="border-top">
        <div class="row fixed-bottom">
          <div class="col ">
            <a href="{{ route('custom.logout') }}" class="btn btn-dark"><i class="bi bi-door-open-fill"></i> Salir</a>
          </div>
        </div>
      </div>
      <!-- SideNav End -->

      <!-- Main Content -->
      <div class="col">
        <h1 class="mt-2">Ausencias</h1>
        <hr class="border-top border-dark">
        <div class="row">
          <div class="col d-flex justify-content-center">
            <div class="card border-dark" style="width: 100rem; height: 90vh; overflow: auto;">
              <!-- Absences Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Dia/Hora Registrado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($absences as $absence)
                    <tr>
                      <th scope="row">{{ $absence->id }}</th>
                      <td>{{ $absence->person_name }}</td>
                      <td>{{ $absence->description }}</td>
                      <td>{{ $absence->created_at }}</td>
                    </tr>
                  @endforeach
              </table>
              <!-- Absences Table End -->
            </div>
          </div>
        </div>
      </div>
      <!-- Main Content End -->

    </div>
  </div>


  <!-- <ul>
    @foreach ($absences as $absence)

      <li>{{ $absence->person_name }}, {{ $absence->description }}</li>
    @endforeach
  </ul> -->

@endsection

@section('scripts')
  <script src="{{ asset('js/absences.js') }}"></script>
@endsection
