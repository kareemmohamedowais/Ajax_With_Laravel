<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    {{-- preview img by Dropify --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add User </h2>
        {{-- alertSuccess div --}}
        <div id="alertSuccess" class="alert alert-success" style="display: none;">
        </div>

        {{-- alertError div --}}
        <div id="alertError" class="alert alert-danger" style="display: none;" >
        </div>
        <form id="formUser" enctype="multipart/form-data" >
            @csrf
            <!-- Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                <small id="nameError" class="text-danger"></small>
            </div>

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                <small id="emailError" class="text-danger"></small>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                <small id="passwordError" class="text-danger"></small>
            </div>
            <!-- image Input -->
            <div class="mb-3">
                <label for="image" class="form-label">image</label>
                <input name="image" type="file" class="form-control dropify"
                data-allowed-formats="portrait square" data-height="300" id="image" placeholder="Enter your image">
                <small id="imageError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <img src="" alt="" id="img_preview" width="200px">
            </div>

            <!-- Governorate Select Box -->
            <div class="mb-3">
                <label for="governorate" class="form-label">Governorate</label>
                <select name="gov_id" class="form-select" id="governorate">
                    <option selected>Select Governorate</option>
                    @foreach ($govs as $gov)
                    <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                    @endforeach

                </select>
                <small id="gov_idError" class="text-danger"></small>
            </div>

            <!-- City Select Box -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select name="city_id" class="form-select" id="city">
                    <option selected>Select gov first</option>
                </select>
                <small id="city_idError" class="text-danger"></small>
            </div>

            <!-- Submit Button -->
            <button id="submitForm" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


    {{-- preview img by Dropify js and must be used jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify({
    messages: {
        'default': 'ارمي الملف هنا',
        'replace': 'لو عايز تبدل الملف دوس هنا ',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    },
    
});
    </script>



    {{-- preview img by jquery --}}
<script>
    $(document).on('change','#image',function(e){
        e.preventDefault()
        file = this.files[0];
        if (file) {
            render = new FileReader();
            render.onload = function(e) {
                $('#img_preview').attr('src', e.target.result);
            }
            render.readAsDataURL(file);
        }
    });
</script>


    {{-- create --}}
    <script>
        $(document).on('click', '#submitForm', function(e) {
            e.preventDefault();

                    // remove validation errors at submit form-control
                    $('#alertError').remove(); // way 1
                    // $('#alertError').empty().hide(); // way 2
                    // $('#alertError').html('').hide(); // way 3
                    $('#nameError').html('').hide();
                    $('#emailError').html('').hide();
                    $('#passwordError').html('').hide();
                    $('#gov_idError').html('').hide();
                    $('#city_idError').html('').hide();

            var formData = new FormData($('#formUser')[0]);
            $.ajax({
                url:"{{ route('users.store') }}",
                type:"POST",
                data:formData,
                processData:false,
                contentType:false,
                enctype:"multipart/form-data",
                success:function(data){
                    // // remove validation errors at submit form-control
                    // $('#alertError').remove(); // way 1
                    // // $('#alertError').empty().hide(); // way 2
                    // // $('#alertError').html('').hide(); // way 3
                    // $('#nameError').html('').hide();
                    // $('#emailError').html('').hide();
                    // $('#passwordError').html('').hide();
                    // $('#gov_idError').html('').hide();
                    // $('#city_idError').html('').hide();

                    // to remove data after adding
                    $('#formUser')[0].reset();

                    // to show alert message after adding
                    $('#alertSuccess').text(data.msg).show();
                    // $('#alertSuccess').css('display','block');

                },
                error:function(data){
                    //show validation errors
                    var  response = $.parseJSON(data.responseText);
                    $.each(response.errors, function(key, value){
                        //  to apper all errors in list
                        $('#alertError').append('<li>'+value+'</li>').show();

                        // to apper each error under fild
                        $('#'+key+'Error').text(value).show();
                    });
                }
            });
        })
    </script>
    {{-- طرقه اضافه الحقول يدويا --}}
    {{-- <script>
        $(document).on('click', '#submitForm', function(e) {
            e.preventDefault();
            $.ajax({
                url:"{{ route('users.store') }}",
                type:"POST",
                data:{
                    '_token':'{{ csrf_token() }}',
                    'name':$('input[name=name]').val(),
                    'email':$('input[name=email]').val(),
                    'password':$('input[name=password]').val(),
                    'gov_id':$('select[name=gov_id]').val(),  // $('#gov_id').val() // by id
                    'city_id':$('select[name=city_id]').val(), // $('#city_id').val() // by id
                },
                success:function(data){
                    // to remove data after adding
                    $('#formUser')[0].reset();

                    // to show alert message after adding
                    $('#alertSuccess').text(data.msg).show();
                    // $('#alertSuccess').css('display','block');




                },
                error:function(data){
                    alert(data);
                }
            });
        })
    </script> --}}

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


</body>
</html>
