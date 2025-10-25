@extends('layouts.default')

@section('title', 'Parties')

@section('content')
<section class="content-header">
    <h1>Parties</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">All Parties</h5>
            <div class="card-tools">
                <a href="{{ route('parties.create') }}" class="btn btn-primary">Add New Party</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Opening Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parties as $party)
                        <tr>
                            <td>{{ $party->id }}</td>
                            <td>{{ $party->name }}</td>
                            <td>{{ $party->type }}</td>
                            <td>{{ $party->opening_balance }}</td>
                            <td>
                                <a href="{{ route('parties.show', $party->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('parties.edit', $party->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('ledger.party.report', $party->id) }}" class="btn btn-sm btn-success" target="_blank">View Ledger</a>
                                <form action="{{ route('parties.destroy', $party->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
