@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recipes</div>
                    <div class="card-body">
                        <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Add New Recipe</a>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="list-group">
                            @foreach ($recipes as $recipe)
                                <a href="{{ route('recipes.show', $recipe->id) }}"
                                    class="list-group-item list-group-item-action">
                                    <h5>{{ $recipe->title }}</h5>
                                    <p>{{ $recipe->description }}</p>
                                    @if ($recipe->image)
                                        <img src="{{ asset('images/' . $recipe->image) }}" class="img-fluid"
                                            alt="{{ $recipe->title }}">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
