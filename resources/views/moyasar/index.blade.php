<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moyasar</title>

         <!-- Moyasar Styles -->
        <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />

        <!-- Moyasar Scripts -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
        <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>


        <!-- Axios Script -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>
    @if (isset($user) && isset($token)  && isset($user))  
    <div style="margin-top: 100px" class="mysr-form"></div>

    <script>
    Moyasar.init({
        element: '.mysr-form',
        // Amount in the smallest currency unit.
        // For example:
        // 10 SAR = 10 * 100 Halalas
        // 10 KWD = 10 * 1000 Fils
        // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
        amount       : {{ $amount * 100 }},
        currency     : 'SAR',
        description  : "Car App wallet re-charge !",
        callback_url : '{{ route("moyasar.approve") }}',
        methods      : ['creditcard'],
        publishable_api_key: 'pk_test_QYcH3Y6kNaNHBo92spPhvAEQXo5EsWeX2Nurvn3Y',
        on_completed: function (payment) {
            return axios.post('{{ route("moyasar.checkout") }}', {
                token : "{{ $token }}",
                payment : payment
            })
        },
        metadata     : {
            'email'   : '{{ $user->email }}',
            'user_id' : 92
        }
    });
    </script>
    @else 
    <div class="container my-5">
        <div class="alert alert-warning">
            <h3 class="text-center">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Please login first !
            </h3>
        </div><!-- /.alert -->
    </div>
    @endif 
    </body>
</html>