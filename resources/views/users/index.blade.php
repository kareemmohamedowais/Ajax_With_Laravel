<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">

        <input type="search" id="searchAjax" name="searchAjax" class="form-control" placeholder="Search here ........">

        <br>

        <h2>User Data</h2>
        <div id="alertSuccess" class="alert alert-success" style="display: none;">

        </div>
<div class="ajaxTable">
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
</div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
{{-- search ajax --}}
    <script>

        // search ajax

        let debounce;

        $(document).on('input', '#searchAjax', function(e) {
            e.preventDefault();
            var searchAjaxValue = $(this).val();
            clearTimeout(debounce);
            debounce = setTimeout(()=>{
                $.ajax({
                url:"{{ route('users.searchAjax') }}",
                type:"POST",
                dataType:'html',
                data:{
                    '_token':'{{ csrf_token() }}',
                    'searchAjaxValue':searchAjaxValue,
                },
                success:function(data){
                    $('.ajaxTable').html(data);
                },
                error:function(data){
                    alert('error');
                }
            });
            },1000);


        });
    </script>
{{-- delete --}}
    <script>
        $(document).on('click', '#delete_btn', function(e) {
            e.preventDefault();

            var user_id = $(this).attr('user_id');

            $.ajax({
                url:"{{ route('users.delete') }}",
                type:"POST",
                data:{
                    '_token':'{{ csrf_token() }}',
                    'user_id':user_id,
                },
                success:function(data){
                    $('.userRow'+user_id).remove();
                    $('#alertSuccess').text(data.msg).show();
                },
                error:function(data){
                    alert(data);
                }
            })
        })
    </script>

</body>
</html>
