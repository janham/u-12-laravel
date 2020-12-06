@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Indexです You are logged in!
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">your_name</th>
                                <th scope="col">email</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <th>{{ $contact -> id}}</th>
                                <td>{{ $contact -> your_name}}</td>
                                <td>{{ $contact -> email}}</td>
                                <td>{{ $contact -> created_at}}</td>
                                <td></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
