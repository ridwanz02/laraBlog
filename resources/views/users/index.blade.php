@extends('layouts.app')
@section('title', 'Users')
@section('pagetitle')
    <h1>Users</h1>
@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <a href="{{ route('create_user') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Add Data</a>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Email</th>
                                    @if (auth()->user()->level=="Admin")
                                    <th>Action</th>
                                    @endif
                                </tr>
                               </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>{{ $item->email }}</td>

                                    @if (auth()->user()->level=="Admin")
                                    <td style="display: flex">
                                        <a href="{{url('edit_user', $item->id)}}" class="badge badge-warning mt-2 mx-1"><button type="submit" class="border-0 bg-transparent text-white">Edit</button></a>
                                        {{-- <a href="{{url('edit_user', $item->id)}}" class="badge badge-success"><button type="submit" class="border-0 bg-transparent text-white pr-3" >Edit</button></a> --}}
                                        <form action="{{url('delete_user', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="badge badge-danger mt-2"><button type="submit" class="border-0 bg-transparent text-white" onclick="return confirm('Yakin hapus data?')">Delete</button></a>
                                        </form>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')

@endpush

@push('after-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();
        });

    </script>
@endpush
