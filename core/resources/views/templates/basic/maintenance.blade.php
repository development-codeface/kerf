<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '404 | page not found') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{ asset('assets/errors/css/main.css') }}">
</head>

<body>
    <div class="error">
        <div class="section flex-column align-items-center justify-content-center m-auto">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-7 text-center">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <h4 class="text-danger">{{ __($maintenance->data_values->heading)}}</h4>
                            </div>
                            <div class="col-sm-6 col-8 mt-3">
                                <img src="{{getImage(getFilePath('maintenance').'/'.@$maintenance->data_values->image,getFileSize('maintenance')) }}" alt="@lang('image')" class="img-fluid mx-auto mb-5">
                            </div>
                        </div>
                        <span class="mx-auto mt-3 text-center">@php echo $maintenance->data_values->description @endphp</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
