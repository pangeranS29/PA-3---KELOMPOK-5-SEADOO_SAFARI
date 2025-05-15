<aside  id="sidebar" class="bg-black text-white w-64 min-h-screen fixed">
    <div class="p-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-2">
            <?php if (isset($component)) { $__componentOriginaldaff26d4e64b9d6b339909684d09d478 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldaff26d4e64b9d6b339909684d09d478 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-mark','data' => ['class' => 'block h-9 w-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-mark'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block h-9 w-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldaff26d4e64b9d6b339909684d09d478)): ?>
<?php $attributes = $__attributesOriginaldaff26d4e64b9d6b339909684d09d478; ?>
<?php unset($__attributesOriginaldaff26d4e64b9d6b339909684d09d478); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldaff26d4e64b9d6b339909684d09d478)): ?>
<?php $component = $__componentOriginaldaff26d4e64b9d6b339909684d09d478; ?>
<?php unset($__componentOriginaldaff26d4e64b9d6b339909684d09d478); ?>
<?php endif; ?>

        </a>


    </div>


    <!-- Navigation Links -->
    <nav class="mt-auto p-4 border-t border-gray-700">
        <ul class="space-y-4">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-gray-700' : ''); ?>">
                    Dashboard
                </a>
            </li>

            

            <li>
                <a href="<?php echo e(route('admin.pilihpakets.index')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('admin.pilihpakets.index') ? 'bg-gray-700' : ''); ?>">
                    Pilih Paket Jetski
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.detail_pakets.index')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('admin.detail_pakets.index') ? 'bg-gray-700' : ''); ?>">
                    Detail Paket
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.bookings.index')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('admin.bookings.index') ? 'bg-gray-700' : ''); ?>">
                    Booking
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.beritas.index')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('admin.news.*') ? 'bg-gray-700' : ''); ?>">
                    Berita
                </a>
            </li>

        </ul>
    </nav>

    <!-- User Profile and Settings -->
    <div class="mt-auto p-4 border-t border-gray-700">
        <!-- User Info -->
        <div class="flex items-center space-x-3">
            <?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>
                <img src="<?php echo e(Auth::user()->profile_photo_url); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="size-10 rounded-full object-cover">
            <?php endif; ?>
            <div>
                <div class="font-medium text-sm"><?php echo e(Auth::user()->name); ?></div>
                <div class="text-xs text-gray-400"><?php echo e(Auth::user()->email); ?></div>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="<?php echo e(route('profile.show')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('profile.show') ? 'bg-gray-700' : ''); ?>">
                        Profile
                    </a>
                </li>
                <?php if(Laravel\Jetstream\Jetstream::hasApiFeatures()): ?>
                    <li>
                        <a href="<?php echo e(route('api-tokens.index')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('api-tokens.index') ? 'bg-gray-700' : ''); ?>">
                            API Tokens
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-700">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Team Management -->
        <?php if(Laravel\Jetstream\Jetstream::hasTeamFeatures()): ?>
            <div class="mt-4">
                <div class="text-xs text-gray-400">Manage Team</div>
                <ul class="mt-2 space-y-2">
                    <li>
                        <a href="<?php echo e(route('teams.show', Auth::user()->currentTeam->id)); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('teams.show') ? 'bg-gray-700' : ''); ?>">
                            Team Settings
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', Laravel\Jetstream\Jetstream::newTeamModel())): ?>
                        <li>
                            <a href="<?php echo e(route('teams.create')); ?>" class="block px-4 py-2 hover:bg-gray-700 <?php echo e(request()->routeIs('teams.create') ? 'bg-gray-700' : ''); ?>">
                                Create New Team
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->allTeams()->count() > 1): ?>
                        <li>
                            <div class="text-xs text-gray-400 mt-2">Switch Teams</div>
                            <ul class="mt-2 space-y-2">
                                <?php $__currentLoopData = Auth::user()->allTeams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php if (isset($component)) { $__componentOriginal12b9baaa9d085739b53a541d2c8778fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12b9baaa9d085739b53a541d2c8778fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.switchable-team','data' => ['team' => $team,'class' => 'block px-4 py-2 hover:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('switchable-team'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['team' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($team),'class' => 'block px-4 py-2 hover:bg-gray-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12b9baaa9d085739b53a541d2c8778fa)): ?>
<?php $attributes = $__attributesOriginal12b9baaa9d085739b53a541d2c8778fa; ?>
<?php unset($__attributesOriginal12b9baaa9d085739b53a541d2c8778fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12b9baaa9d085739b53a541d2c8778fa)): ?>
<?php $component = $__componentOriginal12b9baaa9d085739b53a541d2c8778fa; ?>
<?php unset($__componentOriginal12b9baaa9d085739b53a541d2c8778fa); ?>
<?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</aside>
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/components/sidebar.blade.php ENDPATH**/ ?>