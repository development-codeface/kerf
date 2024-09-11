<?php
$searchContent = getContent('search.content',true);
$locations = \App\Models\Location::orderBy('id', 'DESC')->whereHas('doctors')->get(['id','name']);
$departments = \App\Models\Department::orderBy('id', 'DESC')->whereHas('doctors')->get(['id','name']);
$doctors = \App\Models\Doctor::orderBy('id', 'DESC')->get(['id','name']);
?>
<section style="height: calc(-90px + 100vh);
    display: flex;
    align-items: center;" class="appoint-section ptb-80 bg-overlay-white bg_img" data-background="<?php echo e(getImage('assets/images/frontend/search/'. @$searchContent->data_values->image,'1600x640')); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="appoint-content">
                    <h2 class="title"><?php echo e(__($searchContent->data_values->heading)); ?></h2>
                    <p><?php echo e(__($searchContent->data_values->subheading)); ?></p>
                    <form class="appoint-form" action="<?php echo e(route('doctors.search')); ?>" method="get">
                        <?php echo csrf_field(); ?>
                        <div class="search-location form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="location">
                                    <option value="" selected disabled><?php echo app('translator')->get('Location'); ?></option>
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e(__($item->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="search-location form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="department">
                                    <option value="" selected disabled><?php echo app('translator')->get('Department'); ?></option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e(__($item->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="search-info form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="doctor">
                                    <option value="" selected disabled><?php echo app('translator')->get('Doctor'); ?></option>
                                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e(__($item->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="search-btn cmn-btn"><i class="las la-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/sections/search.blade.php ENDPATH**/ ?>