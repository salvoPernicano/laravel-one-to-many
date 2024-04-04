@extends('layouts.app')

@section('title', 'Modifica Progetto')

@section('content')
<main>
    <h1 class="pageHeader">Edit product</h1>
    <form action="{{ route('dashboard.projects.update', $project ->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="nome_progetto" class="form-label">Nome progetto</label>
            <input type="text" class="form-control @error('nome_progetto') is-invalid @enderror" name="nome_progetto"
                id="nome_progetto" value="{{ old('nome_progetto') ?? $project->nome_progetto }}">
            @error('nome_progetto')
                <div class="invalid-feedback">
                    {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="type_id" class="form-label">Categoria</label>
            <select class="form-control @error('type_id') is-invalid @enderror" name="type_id"
                id="type_id">
            @foreach($types as $element)
                <option value="{{ $element->id }}" 
                    {{ $element->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}>{{ $element->name }}</option>
            @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="technologies" class="form-label">Tecnologie</label>
            <select multiple class="form-control @error('type_id') is-invalid @enderror" name="technologies[]"
                id="technologies">
            @forelse($technologies as $element)
            @if($errors->any())
            <option value="{{ $element->id }}" {{ in_array($element->id, old('technologies', [])) ? 'selected' : '' }}>{{ $element->name }}</option>
                @else
                <option value="{{ $element->id }}"{{$project->technologies->contains($element->id) ? 'selected' : ''}}>{{ $element->name }}</option>
            @endif      
            @empty
                <option value="">Nessuna selezione</option>
            @endforelse
            </select>

        </div>
        <div>
            <label for="descrizione_progetto" class="form-label">descrizione progetto</label>
            <textarea type="text" class="form-control @error('descrizione_progetto') is-invalid @enderror"
                name="descrizione_progetto" id="descrizione_progetto" rows="3"> {{old('descrizione_progetto') ?? $project->descrizione_progetto}}</textarea>
            @error('descrizione_progetto')
                <div class="invalid-feedback">
                    {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="linguaggi" class="form-label">linguaggi usati</label>
            <input type="text" class="form-control @error('linguaggi') is-invalid @enderror" name="linguaggi"
                id="linguaggi" value="{{ old('linguaggi')  ?? $project->linguaggi  }}">
            @error('linguaggi')
                <div class="invalid-feedback">
                    {{ $message }} </div>
            @enderror
        </div>
        <div>
            @if($project->immagine){
                <img src="{{ asset('/storage/'.$project->immagine) }}" alt="">
            }
            @endif
            <label for="immagine" class="form-label">url immagine</label>
            <input type="file" class="form-control @error('immagine') is-invalid @enderror" name="immagine"
                id="immagine">
            @error('immagine')
                <div class="invalid-feedback">
                    {{ $message }} </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Crea</button>

    </form>
</main>
@endsection