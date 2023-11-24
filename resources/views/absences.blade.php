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
        <!-- Filter -->
        <div class="row">
          <div class="col">
            <form id="filter">
              <div class="form-group">
                <label for="statusFilter">Filtro por Estado</label>
                <select onChange="filter(this.value)" class="form-control" id="statusFilter">
                <option value="Todos" {{ $selectedStatus === 'Todos' ? 'selected' : '' }}>Todos</option>
                <option value="Pendiente" {{ $selectedStatus === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Aceptada" {{ $selectedStatus === 'Aceptada' ? 'selected' : '' }}>Aceptada</option>
                <option value="Rechazada" {{ $selectedStatus === 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
              </div>
            </form>
          </div>
        </div>
        <!-- End Filter -->
        <div class="row">
          <div class="col d-flex justify-content-center">
            <div class="card border-dark" style="width: 100rem; height: 80vh; overflow: auto;">
              <!-- Absences Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Dia/Hora Registrado</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($absences as $absence)
                    <tr>
                      <th scope="row">{{ $absence->id }}</th>
                      <td>{{ $absence->person_name }}</td>
                      <td>{{ $absence->description }}</td>
                      <td>{{ '+' . substr($absence->phone, 0, 3) . ' ' . substr($absence->phone, 3, 4) . ' ' . substr($absence->phone, 7, 4) }}</td>
                      <td>{{ $absence->created_at }}</td>
                      <td>{{ $absence->status }}</td>
                      <td>
                        @if($absence->status === 'Pendiente')
                          <div class="row">
                            <div class="col">
                              <form action="{{route('absences.accept', ['id' => $absence->id])}}" method="POST">
                              @csrf
                              @method('PUT')
                              <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i></button>
                              </form>
                            </div>
                            <div class="col">
                              <form action="{{route('absences.reject', ['id' => $absence->id])}}" method="POST">
                              @csrf
                              @method('PUT')
                              <button type="submit" class="btn btn-danger"><i class="bi bi-x"></i></button>
                              </form>
                            </div>
                          </div>
                        @endif
                      </td>
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

@endsection

@section('scripts')
<script>

  console.log("hello");

</script>
<script type="text/javascript" src="{{ asset('js/absences.js') }}"></script>

@endsection
