@extends('layouts.customer')


@section('title')
   Pain & Gain
@endsection


@section('content')

<div class="py-5"></div>
<div class="container">
    <!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Mengalami kesulitan dalam berbelanja hubungi saya.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" >
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Your name</label>
                            <input type="text" id="name" value="" name="name" required class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Your email</label>
                            <input type="text" id="email" value=""    name="email" required class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Subject</label>
                            <input type="text" id="subject" value="" name="subject" required class="form-control">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message">Pesan Kamu</label>
                            <textarea type="text" id="message" value="" name="message" required rows="2" class="form-control md-textarea"></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <a class="w-100 p-2 message btn btn-outline-primary" type="button">Kirim Pesan</a>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Jakarta Barat Indonesia</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 6281278787878</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>gomgom@gmail.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->
</div>
<div class="py-5"></div>

    
@endsection

@section('scripts')
<script>
 $('.message').click(function(e){
            e.preventDefault();
            var name = $('#name').val();
            var email =$('#email').val();
            var subject =$('#subject').val();
            var message = $('#message').val();


            console.log(name , email , subject , message)

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                method : "POST",
                url : "/sendMessage",
                data : {
                    'name': name,
                    'email': email,
                    'subject': subject,
                    'message': message,
                },
                success: function(response)
                {
                    if(response.status === "Please Login First...")
                    {

                        swal("Oops...", `${response.status}`, "error");
                    }
                    else if(response.status === "Please Verify you Email")
                    {

                        swal("Oops...", `${response.status}`, "error");
                    }
                    else if(response.status === undefined)
                    {

                        swal("Oops...", `We are unable to deliver your message`, "info");
                    }
                    else if(response.status === 'Kindly Fill Form Correctly')
                    {

                        swal("Oops...", `${response.status}`, "error");
                    }
                    else
                    {
                        swal("Done!", `${response.status}`, "success");
                    }
                }
            })
        })

</script>
@endsection

