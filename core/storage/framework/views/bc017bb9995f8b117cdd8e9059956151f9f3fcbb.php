<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo e($general->siteName(__($pageTitle))); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/line-awesome.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/nice-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/chosen.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/themify.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/animate.css')); ?>">
    <!-- main style css link -->
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/style.css')); ?>">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <?php echo $__env->yieldPushContent('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/color.php')); ?>?color=<?php echo e($general->base_color); ?>">
</head>

<body>
    <?php echo $__env->yieldPushContent('fbComment'); ?>
    <div class="body-overlay"></div>

    <div class="loader">
        <!-- <div class="heartbeatloader">
            <svg class="svgdraw" width="100%" height="100%" viewBox="0 0 150 400">
                <path class="path"
                    d="M 0 200 l 40 0 l 5 -40 l 5 40 l 10 0 l 5 15 l 10 -140 l 10 220 l 5 -95 l 10 0 l 5 20 l 5 -20 l 30 0"
                    fill="transparent" stroke-width="4" stroke="black" />
            </svg>
            <div class="innercircle"></div>
            <div class="outercircle"></div>
        </div> -->

        <div class="a1b2c3">
            <div role="status" class="d4e5f6">
                <img
                    alt="Logo"
                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.svg')); ?>"
                    loading="eager"
                    class="g7h8i9" />
                <div class="j0k1l2"></div>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>

    <?php echo $__env->make($activeTemplate . 'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- <div class="scrollToTop">
        <span class="scroll-icon">
            <i class="fa fa-angle-up"></i>
        </span>
    </div> -->

    <div class="all-sections">
        <?php if(!request()->routeIs('home')): ?>
        <?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make($activeTemplate . 'partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo e(asset('assets/global/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/jquery.nice-select.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/chosen.jquery.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/main.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script-lib'); ?>

    <?php echo $__env->yieldPushContent('script'); ?>

    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "<?php echo e(route('home')); ?>/change/" + $(this).val();
            });

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                matched = event.matches;
                if (matched) {
                    $('body').addClass('dark-mode');
                    $('.navbar').addClass('navbar-dark');
                } else {
                    $('body').removeClass('dark-mode');
                    $('.navbar').removeClass('navbar-dark');
                }
            });

            let matched = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (matched) {
                $('body').addClass('dark-mode');
                $('.navbar').addClass('navbar-dark');
            } else {
                $('body').removeClass('dark-mode');
                $('.navbar').removeClass('navbar-dark');
            }

            var inputElements = $('input,select');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

        })(jQuery);
    </script>

</body>

</html><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>