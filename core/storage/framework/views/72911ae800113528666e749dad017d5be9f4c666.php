<?php
$footerContent = getContent('footer.content', true);
$contactElement = getContent('contact_us.element', false);
$subscribeContent = getContent('subscribe.content', true);
$socialIcons = getContent('social_icon.element', false, null, true);

$departments = \App\Models\Department::orderBy('id', 'DESC')->take(6)->get();
$locations = \App\Models\Location::orderBy('id', 'DESC')->take(6)->get();
?>

<!-- call-to-action section start -->
<section class="call-to-action-section">
    <div class="container">
        <div class="row justify-content-center align-self-center">
            <div class="col-lg-8 text-center">
                <div class="call-to-action-area">
                    <div class="call-info">
                        <div class="call-info-thumb">
                            <img src="<?php echo e(getImage('assets/images/frontend/footer/' . @$footerContent->data_values->emergency_contact_image)); ?>"
                                alt="<?php echo app('translator')->get('Emergency Contact'); ?>">
                        </div>
                        <div class="call-info-content">
                            <h4 class="title">
                                <span><?php echo app('translator')->get('Emergency Call'); ?></span>
                                <a hre="tel:<?php echo e(@$footerContent->data_values->emergency_contact); ?>">
                                    <?php echo e(__($footerContent->data_values->emergency_contact)); ?></a>
                            </h4>
                        </div>
                    </div>
                    <div class="mail-info">
                        <div class="mail-info-thumb">
                            <img src="<?php echo e(getImage('assets/images/frontend/footer/' . @$footerContent->data_values->emergency_email_image)); ?>"
                                alt="<?php echo app('translator')->get('Emergency E-mail'); ?>">
                        </div>
                        <div class="mail-info-content">
                            <h4 class="title">
                                <span><?php echo app('translator')->get('24/7 Email Support'); ?></span>
                                <a
                                    href="mailto:<?php echo e(@$footerContent->data_values->emergency_email); ?>"><?php echo e(__($footerContent->data_values->emergency_email)); ?></a>
                            </h4>
                        </div>
                    </div>
                    <span class="dc-or-text">- <?php echo app('translator')->get('OR'); ?> -</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- call-to-action section end -->

<!-- footer-section start -->
<!-- <footer class="footer-section ptb-80">
    <div class="custom-container">
        <div class="footer-area">
            <div class="row ml-b-30">
                <div class="col-lg-4 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="<?php echo e(route('home')); ?>" class="site-logo">
                                <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="logo"></a>
                        </div>
                        <p><?php echo e(__($footerContent->data_values->footer_details)); ?></p>
                        <ul class="footer-contact">
                            <?php $__currentLoopData = $contactElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo $contact->data_values->contact_icon ?> <?php echo e(__($contact->data_values->content)); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title"><?php echo app('translator')->get('Department Based'); ?></h3>
                        <ul class="footer-menus">
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('doctors.departments',$department->id)); ?>"><i class="fas fa-long-arrow-alt-right"></i><?php echo e(__($department->name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title"><?php echo app('translator')->get('Area Based'); ?></h3>
                        <ul class="footer-menus">
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('doctors.locations',$location->id)); ?>"><i class="fas fa-long-arrow-alt-right"></i><?php echo e(__($location->name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title"><?php echo e(__($subscribeContent->data_values->heading)); ?></h3>
                        <p><?php echo e(__($subscribeContent->data_values->subheading)); ?></p>
                        <form class="footer-form">
                            <input type="email" name="email" id="subscriber" placeholder="<?php echo app('translator')->get('Enter Your Email'); ?>"
                                autocomplete="off">
                            <button type="submit" class="submit-btn"><i class="lab la-telegram-plane"></i></button>
                        </form>
                        <div class="social-area">
                            <ul class="footer-social">
                                <?php $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($social->data_values->url); ?>" target="_blank">
                                        <?php echo $social->data_values->social_icon ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> -->

<!-- <div class="privacy-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright-area d-flex flex-wrap align-items-center justify-content-center">
                    <div class="copyright">
                        <p><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(\Carbon\Carbon::now()->format('Y')); ?> | <?php echo app('translator')->get('All Rights Reserved'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div style="background-color: #2eb7b7;">

    <div class="j8n-footer-container container">
        <p class="k3m-copyright">
            Ⓒ 2024 KERF Hospital. All rights reserved | Designed by
            <a href="https://codefacetech.com/" target="_blank" class="l2p-designer-link">Codeface Technologies</a>
        </p>
    </div>
</div>

<?php $__env->startPush('script'); ?>
<script>
    'use strict';

    $(function() {

        $('.footer-form').on('submit', function(event) {
            event.preventDefault();
            let url = `<?php echo e(route('subscribe')); ?>`;

            let data = {
                email: $(this).find('input[name=email]').val()
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                }
            });

            $.post(url, data, function(response) {
                if (response.errors) {
                    for (var i = 0; i < response.errors.length; i++) {
                        iziToast.error({
                            message: response.errors[i],
                            position: "topRight"
                        });
                    }
                } else {
                    $('.footer-form').trigger("reset");
                    iziToast.success({
                        message: response.success,
                        position: "topRight"
                    });
                }
            });
            this.reset();
        })
    })
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>