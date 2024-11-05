<?php $__env->startSection('content'); ?>
<div class="container ptb-80">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card custom--card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo app('translator')->get('Razorpay'); ?></h5>
                </div>
                <div class="card-body p-5">
                    <ul class="list-group text-center">
                        <li class="list-group-item d-flex justify-content-between">
                            <?php echo app('translator')->get('You have to pay '); ?>:
                            <strong><?php echo e(showAmount($deposit->final_amo)); ?> <?php echo e(__($deposit->method_currency)); ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <?php echo app('translator')->get('You will get '); ?>:
                            <strong><?php echo e(showAmount($deposit->amount)); ?>  <?php echo e(__($general->cur_text)); ?></strong>
                        </li>
                    </ul>
                     <form action="<?php echo e($data->url); ?>" method="<?php echo e($data->method); ?>">
                        <input type="hidden" custom="<?php echo e($data->custom); ?>" name="hidden">
                        <script src="<?php echo e($data->checkout_js); ?>"
                                <?php $__currentLoopData = $data->val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                data-<?php echo e($key); ?>="<?php echo e($value); ?>"
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> >
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $('input[type="submit"]').addClass("mt-4 btn btn--base w-100");
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/user/payment/Razorpay.blade.php ENDPATH**/ ?>