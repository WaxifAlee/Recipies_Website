@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Document</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="document">Choose Document</label>
                                <input type="file" class="form-control-file" id="document" name="document" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Uploaded Documents</div>
                    <div class="card-body">
                        @if ($documents->isEmpty())
                            <p>No documents uploaded yet.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($documents as $document)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ $document->file_path }}" target="_blank">{{ $document->file_name }}</a>
                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
