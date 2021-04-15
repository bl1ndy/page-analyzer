@extends('index')

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Page Analizator</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Check sites for SEO optimization</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <form action="{{ route('home') }}" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                    @csrf
                    <div class="col-12">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Url</label>
                        <div class="input-group">
                            <div class="input-group-text">>>></div>
                            <input type="text" class="form-control" id="name" name="url[name]" placeholder="Type URL here">
                        </div>
                    </div>
                  
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Go!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
