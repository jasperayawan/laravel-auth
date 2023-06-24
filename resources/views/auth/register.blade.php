@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="fw-bold text-secondary text-center">Register</h2>
                    </div>
                    <div class="card-body p-5">
                        <form action="" method="POST" id="register_form">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control rounded-0"
                                    placeholder="Full Name">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-0"
                                    placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control rounded-0"
                                    placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0"
                                    placeholder="Confirm Password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 d-grid">
                                <input type="submit" value="Register" class="btn btn-dark rounded-0" 
                                id="register_btn">
                            </div>

                            <div class="text-center text-secondary">
                                <div class="">Already have an account? <a href="/" class="text-decoration-none">Login Here</a></div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(function(){
        $("#register_form").submit(function(e){
            e.preventDefault();

            $("#register_btn").val("Please wait...");

            $.ajax({
                url: '{{ route('auth.register') }}',
                method: 'post',
                //send all the form data
                //sserialize method to send the data
                data: $(this).serialize(),
                // dataType: 'json',
                success: function(res){
                    console.log(res)
                }
            })
        })
    })
</script>
@endsection