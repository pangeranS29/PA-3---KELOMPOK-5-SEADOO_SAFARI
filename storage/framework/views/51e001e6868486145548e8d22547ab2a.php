<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div
        class="w-full max-w-md bg-gray-900 bg-opacity-80 backdrop-blur-sm rounded-xl p-8 border border-gray-800 shadow-2xl">
        <div class="text-center mb-2">
            <i class="fas fa-user-circle text-5xl text-yellow-500 mb-4"></i>
        </div>

        <h2 class="text-3xl font-bold text-center mb-8 text-yellow-400">Login</h2>

        <?php if(session('status')): ?>
            <div class="mb-4 font-medium text-sm text-green-500">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Tambahkan input hidden untuk redirect_to -->
            <input type="hidden" name="redirect_to" value="<?php echo e(request('redirect_to')); ?>">

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-gray-400 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </span>
                    <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="w-full pl-10 p-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:outline-none focus:border-yellow-500 transition duration-300 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-400 mb-2">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-500"></i>
                    </span>
                    <input id="password" name="password" type="password" required
                        class="w-full pl-10 p-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:outline-none focus:border-yellow-500 transition duration-300 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-700 bg-gray-800 text-yellow-500 shadow-sm focus:ring-yellow-500"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-400">Ingat saya</span>
                </label>
                <?php if(Route::has('password.request')): ?>
                    <a class="text-sm text-yellow-500 hover:text-yellow-400 hover:underline"
                        href="<?php echo e(route('password.request')); ?>">
                        Lupa Kata Sandi?
                    </a>
                <?php endif; ?>
            </div>

            <button type="submit"
                class="w-full p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-black font-bold rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition duration-300 shadow-lg hover:shadow-yellow-500/20">
                Masuk
            </button>
        </form>



        <div class="mt-8 text-center text-gray-400">
            Belum punya akun?
            <a href="<?php echo e(route('register')); ?>" class="text-yellow-500 hover:text-yellow-400 hover:underline">Daftar
                Sekarang</a>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/auth/login.blade.php ENDPATH**/ ?>