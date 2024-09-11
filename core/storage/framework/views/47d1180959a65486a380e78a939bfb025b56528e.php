<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => '#','icon' => 'las la-wallet f-size--56','title' => 'Total Online Earn','value' => ''.e($general->cur_sym).''.e(showAmount($totalOnlineEarn)).'','bg' => '19']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => '#','icon' => 'las la-wallet f-size--56','title' => 'Total Online Earn','value' => ''.e($general->cur_sym).''.e(showAmount($totalOnlineEarn)).'','bg' => '19']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => '#','icon' => 'las la-hand-holding-usd f-size--56','title' => 'Total Cash Earn','value' => ''.e($general->cur_sym).''.e(showAmount($totalCashEarn)).'','bg' => '11']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => '#','icon' => 'las la-hand-holding-usd f-size--56','title' => 'Total Cash Earn','value' => ''.e($general->cur_sym).''.e(showAmount($totalCashEarn)).'','bg' => '11']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['link' => '#','icon' => 'las la-handshake f-size--56','title' => 'Total Appointments','value' => ''.e($totalAppointments).'','bg' => '3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => '#','icon' => 'las la-handshake f-size--56','title' => 'Total Appointments','value' => ''.e($totalAppointments).'','bg' => '3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','icon' => 'las la-check-circle f-size--56','title' => 'Total Done Appointments','value' => ''.e($completeAppointments).'','bg' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','icon' => 'las la-check-circle f-size--56','title' => 'Total Done Appointments','value' => ''.e($completeAppointments).'','bg' => 'success']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','icon' => 'las la-calendar-day f-size--56','title' => 'Total Booking Days','value' => ''.e($doctor->serial_day).'','bg' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','icon' => 'las la-calendar-day f-size--56','title' => 'Total Booking Days','value' => ''.e($doctor->serial_day).'','bg' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-4 col-sm-6">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widget','data' => ['style' => '3','icon' => 'las la-trash f-size--56','title' => 'Total Trashed Appointments','value' => ''.e($trashedAppointments).'','bg' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '3','icon' => 'las la-trash f-size--56','title' => 'Total Trashed Appointments','value' => ''.e($trashedAppointments).'','bg' => 'danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
                <!-- dashboard-w1 end -->
            </div>

            <div class="d-flex flex-wrap gap-3 mt-4">
                <div class="flex-fill">
                    <a href="<?php echo e(route('admin.doctor.login.history', $doctor->id)); ?>" class="btn btn--primary w-100 btn-lg">
                        <i class="las la-history"></i><?php echo app('translator')->get('Login History'); ?>
                    </a>
                </div>
                <div class="flex-fill">
                    <a href="<?php echo e(route('admin.doctor.notification.log', $doctor->id)); ?>"
                        class="btn btn--warning w-100 btn-lg">
                        <i class="las la-envelope"></i><?php echo app('translator')->get('Notification Logs'); ?>
                    </a>
                </div>
                <div class="flex-fill">
                    <a href="<?php echo e(route('admin.doctor.login', $doctor->id)); ?>" target="_blank"
                        class="btn btn--primary btn--gradi w-100 btn-lg">
                        <i class="las la-sign-in-alt"></i><?php echo app('translator')->get('Login as Doctor'); ?>
                    </a>
                </div>
            </div>
            <div class="card mt-30">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?php echo app('translator')->get('Information of'); ?> <?php echo e($doctor->name); ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.doctor.store', $doctor->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Image'); ?></label>
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview"
                                                        style="background-image: url(<?php echo e(getImage(getFilePath('doctorProfile') . '/' . $doctor->image, getFileSize('doctorProfile'))); ?>)">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit mt-0">
                                                    <input type="file" class="profilePicUpload" name="image"
                                                        value="<?php echo e($doctor->image); ?>" id="profilePicUpload1"
                                                        accept=".png, .jpg, .jpeg">
                                                    <label for="profilePicUpload1"
                                                        class="btn btn--success btn-block btn-lg"><?php echo app('translator')->get('Upload'); ?></label>
                                                    <small><?php echo app('translator')->get('Support Images'); ?>:
                                                        <b><?php echo app('translator')->get('jpeg'); ?>, <?php echo app('translator')->get('jpg'); ?>, <?php echo app('translator')->get('png'); ?>,</b> <?php echo app('translator')->get('resized into 400x400px'); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Name'); ?></label>
                                            <input type="text" name="name" value="<?php echo e($doctor->name); ?>"
                                                class="form-control " required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Username'); ?></label>
                                            <input type="text" name="username" value="<?php echo e($doctor->username); ?>"
                                                class="form-control " required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('E-mail'); ?></label>
                                            <input type="text" name="email" value="<?php echo e($doctor->email); ?>"
                                                class="form-control " required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo app('translator')->get('Mobile'); ?>
                                                <i class="fa fa-info-circle text--primary" title="<?php echo app('translator')->get('Add the country code by general setting. Otherwise, SMS won\'t send to that number.'); ?>">
                                                </i>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->country_code); ?></span>
                                                <input type="number" name="mobile"
                                                    value="<?php echo e(str_replace($general->country_code, '', $doctor->mobile)); ?>"
                                                    class="form-control " autocomplete="off" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group select2-wrapper" id="select2-wrapper-one">
                                            <label><?php echo app('translator')->get('Department'); ?></label>
                                            <select class="select2-basic-one form-control" name="department" required>
                                                <option disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($department->id == @$doctor->department_id): echo 'selected'; endif; ?> value="<?php echo e(old('department',$department->id)); ?>">
                                                        <?php echo e(__($department->name)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group select2-wrapper" id="select2-wrapper-two">
                                            <label><?php echo app('translator')->get('Location'); ?></label>
                                            <select class="select2-basic-two form-control" name="location" required>
                                                <option disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($location->id == @$doctor->location_id): echo 'selected'; endif; ?> value="<?php echo e($location->id); ?>">
                                                        <?php echo e(__($location->name)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> <?php echo app('translator')->get('Fees'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                <input type="number" name="fees" value="<?php echo e($doctor->fees); ?>"
                                                    class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> <?php echo app('translator')->get('Qualification'); ?></label>
                                            <input type="text" name="qualification"
                                                value="<?php echo e($doctor->qualification); ?>" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> <?php echo app('translator')->get('Revisit Fees'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                                <input type="number" name="revisit_fees" value="<?php echo e($doctor->revisit_fees); ?>"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Address'); ?> </label>
                                        <textarea name="address" class="form-control" required><?php echo e($doctor->address); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="from-group">
                                <label><?php echo app('translator')->get('About'); ?> </label>
                                <textarea name="about" class="form-control" required><?php echo e($doctor->about); ?></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.doctor.index')); ?>" class="btn btn-sm btn-outline--primary"><i class="la la-undo"></i>
        <?php echo app('translator')->get('Back'); ?> </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/admin/doctor/details.blade.php ENDPATH**/ ?>