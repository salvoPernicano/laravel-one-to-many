@extends('layouts.app')

@section('content')
<main class="container">
    <h1>Lista progetti</h1>
    <a class="btn btn-success" href="{{ route('dashboard.projects.create') }}">Crea nuovo progetto</a>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">#id</th>
                <th scope="col">Nome progetto</th>
                <th scope="col">slug</th>
                <th scope="col">descrizione</th>
                <th scope="col">linguaggi</th>
                <th scope="col">immagini</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach($projects as $item)
              <tr>
                <th scope="row">{{ $item->id }}</th>
      
                <td><a  href="{{ route('dashboard.projects.show', $item->id) }}">{{ $item->nome_progetto }}</a></td>
                <td>{{ $item->slug }}</td>
                <td>{{ $item->descrizione_progetto }}</td>
                <td>{{ $item->linguaggi }}</td>
                <td>{{ $item->immagine }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('dashboard.projects.edit', $item->id) }}">Modifica progetto</a>
                    <form action="{{ route('dashboard.projects.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Elimina progetto</button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</main>
@endsection