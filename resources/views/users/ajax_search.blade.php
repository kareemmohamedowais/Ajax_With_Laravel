<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Governorate</th>
            <th>City</th>
            <th>actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr class="userRow{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->governorate->name }}</td>
                <td>{{ $user->city->name }}</td>
                <td>
                    <button id="delete_btn" user_id="{{ $user->id }}" class="btn btn-danger">delete</button>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="ajaxPaginationSearch">
    {{ $users->links() }}
</div>
