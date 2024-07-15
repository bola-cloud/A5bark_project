<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moyasar Checkout</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container my-5">
        @if (session('success') == 'paid')
        <div class="alert alert-success text-center">
            
            <h3>
                <i class="fa-solid fa-1x fa-circle-check"></i>
                Payment success !
            </h3>
        </div><!-- /.alert -->
        @else
        <div class="alert alert-danger">
            <h3 class="text-center">
                <i class="fa-solid fa-circle-xmark"></i>
                Payment failed !
            </h3>
        </div><!-- /.alert -->
        @endif
    </div><!-- /.container -->
</body>
</html>