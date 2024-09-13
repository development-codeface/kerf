<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => '','icon' => 'las la-wallet f-size--56','title' => 'Total Online Earn','value' => ''.e(showAmount($widget['total_online_earn'])).'','bg' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => '','icon' => 'las la-wallet f-size--56','title' => 'Total Online Earn','value' => ''.e(showAmount($widget['total_online_earn'])).'','bg' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => '','icon' => 'las la-hand-holding-usd f-size--56','title' => 'Total Cash Earn','value' => ''.e(showAmount($widget['total_cash_earn'])).'','bg' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => '','icon' => 'las la-hand-holding-usd f-size--56','title' => 'Total Cash Earn','value' => ''.e(showAmount($widget['total_cash_earn'])).'','bg' => '12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => ''.e(route('doctor.appointment.new')).'','icon' => 'lar la-handshake f-size--56','title' => 'Total New Appointment','value' => ''.e($widget['total_new_appointment']).'','bg' => 'info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => ''.e(route('doctor.appointment.new')).'','icon' => 'lar la-handshake f-size--56','title' => 'Total New Appointment','value' => ''.e($widget['total_new_appointment']).'','bg' => 'info']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => ''.e(route('doctor.appointment.done')).'','icon' => 'las la-check-circle f-size--56','title' => 'Total Done Appointment','value' => ''.e($widget['total_done_appointment']).'','bg' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => ''.e(route('doctor.appointment.done')).'','icon' => 'las la-check-circle f-size--56','title' => 'Total Done Appointment','value' => ''.e($widget['total_done_appointment']).'','bg' => 'success']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row">
        <h5 class="my-3"><?php echo app('translator')->get('Assistant List'); ?></h5>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Assistant'); ?></th>
                                    <th><?php echo app('translator')->get('Mobile'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?></th>
                                    <th><?php echo app('translator')->get('Joined At'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $assistantsDoctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($assistantsDoctor->firstItem() + $loop->index); ?></td>
                                        <td><?php echo e(__($item->assistant->name)); ?></td>
                                        <td><?php echo e($item->assistant->mobile); ?></td>
                                        <td><?php echo e($item->assistant->email); ?></td>
                                        <td><?php echo e(showDateTime($item->assistant->created_at)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($assistantsDoctor->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($assistantsDoctor) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <div class="row">
        <h5 class="my-3"><?php echo app('translator')->get('Login History'); ?></h5>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Login at'); ?></th>
                                    <th><?php echo app('translator')->get('IP'); ?></th>
                                    <th><?php echo app('translator')->get('Location'); ?></th>
                                    <th><?php echo app('translator')->get('Browser | OS'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $loginLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <?php echo e(showDateTime($log->created_at)); ?> <br> <?php echo e(diffForHumans($log->created_at)); ?>

                                        </td>
                                        <td><?php echo e($log->doctor_ip); ?> </td>
                                        <td><?php echo e(__($log->city)); ?> <br> <?php echo e(__($log->country)); ?></td>
                                        <td>
                                            <?php echo e(__($log->browser)); ?> <br> <?php echo e(__($log->os)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/doctor/dashboard.blade.php ENDPATH**/ ?>