<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
                {{-- alertSuccess div --}}
                <div id="alertSuccess" class="alert alert-success" style="display: none;">
                </div>
        <h2>User update</h2>

        <form id="formUser">
            <!-- Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" >
            </div>
                <input type="hidden" name="id" value="{{ $user->id }}">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" >
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="{{ $user->password }}" >
            </div>

            <!-- Governorate Select Box -->
            <div class="mb-3">
                <label for="governorate" class="form-label">Governorate</label>
                <select name="gov_id" class="form-select" id="governorate">
                    <option >Select Governorate</option>
                    @foreach ($govs as $gov)
                    <option value="{{ $gov->id }}" @selected($gov->id == $user->gov_id)>{{ $gov->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- City Select Box -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select name="city_id" class="form-select" id="city">
                    <option >Select City</option>
                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}" @selected($city->id == $user->city_id)>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button id="updateForm" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

        {{-- select cities based on governorate --}}
        <script>
            $(document).on('change', '#governorate', function(e) {
                e.preventDefault();
                var governorate_id = $(this).val();
                $.ajax({
                    url:"{{ route('users.getCities') }}",
                    type:"POST",
                    data:{
                        '_token':'{{ csrf_token() }}',
                        'governorate_id':governorate_id,
                    },
                    success:function(data){

                        $('#city').empty();
                        $('#city').append('<option selected disabled>Select city</option>');
                        $.each(data,function(key,value){
                            $('#city').append('<option value="'+value.id+'">'+value.name+'</option>');
                        });



                    },
                    error:function(data){

                    }
                });
            })
        </script>


{{-- update form --}}
    <script>
        $(document).on('click', '#updateForm', function(e) {
            e.preventDefault();
            $.ajax({
                url:"{{ route('users.update') }}",
                type:"POST",
                data:{
                    '_token':'{{ csrf_token() }}',
                    'id':$('input[name=id]').val(),
                    'name':$('input[name=name]').val(),
                    'email':$('input[name=email]').val(),
                    'password':$('input[name=password]').val(),
                    'gov_id':$('select[name=gov_id]').val(),  // $('#gov_id').val() // by id
                    'city_id':$('select[name=city_id]').val(), // $('#city_id').val() // by id
                },
                success:function(data){
                    // to remove data after adding
                    // $('#formUser')[0].reset();

                    if (data.status ==200) {
                    // to show alert message after adding
                    $('#alertSuccess').text(data.msg).show();
                    // $('#alertSuccess').css('display','block');

                    }else{
                        $('#alertSuccess').text('failed').show();

                    }


                },
                error:function(data){
                    alert(data);
                }
            });
        })
    </script>
</body>
</html>
