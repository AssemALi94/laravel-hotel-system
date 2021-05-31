 @extends('layouts.master')
 @section('title')
     Deleted Users
 @endsection
 @section('content')
     @if (count($users) > 0)
         <table class="table table-striped bg-white table-bordered">
             <tr>
                 <th>name</th>
                 <th>role</th>
                 <th>deleted at</th>
                 <th>Action</th>
             </tr>
             @foreach ($users as $user)
                 <tr>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->role }}</td>
                     <td>{{ $user->deleted_at }}</td>

                     <td><a href="/restoreuser/{{ $user->id }}"
                             class="btn btn-secondary">restore</a>

                     <a href="/deletedusers/{{ $user->id }}" onclick="return confirm('Are you sure to delete user?')" class="btn btn-danger">Delete</a>
                     </td>

                 </tr>
             @endforeach
         </table>
     @else
         <p>You have no Users</p>
     @endif
 @endsection
