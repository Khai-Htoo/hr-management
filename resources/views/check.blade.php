<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/pinInput.css') }}">
    <style>
        .swal2-confirm .swal2-styled{
            display: none;
        }
    </style>
</head>

<body>
    <div class="row justify-content-center align-items-center" style=" height : 100vh">
        <div class="col-md-5">
            <div class="card ">
                <div class="card-body px-3 pt-5">
                    <div class="d-flex justify-content-center">
                        <div class=" text-center">
                            <h4>QR Code</h4>
                            <div class="qr p-5">
                                {!! QrCode::generate($date) !!}
                                <p class=" mt-3">Please scan QR to check in or check out</p>
                            </div>
                            <div class="mx-5 text-center" style=" width : 300px">
                                <h4>Pin Code</h4>
                                <input type="text" name="mycode" id="pincode-input1">
                            </div>
                            <p class=" mt-2">Please enter your pin code to check in or check out</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/pinInput.js') }}"></script>
<script>
    $(document).ready(function() {

        // csrf token
        let token = document.head.querySelector('meta[name="csrf-token"]')

        if (token) {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': token.content
                }
            })
        }

        $('#pincode-input1').pincodeInput({
            inputs: 6,
            complete: function(value, e, errorElement) {
                var saveData = $.ajax({
                    type: 'POST',
                    url: "/checkin",
                    data: {
                        'pin_code': value
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            const Toast = Swal.mixin({
                                // toast: true,
                                position: 'top-center',
                            })

                            Toast.fire({
                                icon: 'success',
                                title: res.msg
                            })
                            $('.pincode-input-text').val('')
                        }
                        if(res.status == 'fail'){
                            const Toast = Swal.mixin({
                                // toast: true,
                                position: 'top-center',
                            })

                            Toast.fire({
                                icon: 'error',
                                title: res.msg
                            })
                            $('.pincode-input-text').val('')
                        }
                    }
                });
                $(errorElement).html($error);
            }
        });
    })
</script>

</html>
