@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $recipe->title }}</div>
                    <div class="card-body">
                        <p>{{ $recipe->description }}</p>
                        @if ($recipe->image)
                            <img src="{{ asset('images/' . $recipe->image) }}" class="img-fluid" alt="{{ $recipe->title }}">
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
