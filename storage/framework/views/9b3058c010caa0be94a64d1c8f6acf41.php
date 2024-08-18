 <!-- Scripts -->
 <script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
 <script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
 <script src="<?php echo e(asset('adminlte/dist/js/adminlte.min.js')); ?>"></script>

 <script>
     $(document).ready(function() {
         $('input[name="user_type"]').on('change', function() {
             if ($(this).val() === 'student') {
                 $('#email-field').hide();
                 $('#reg-num-field').show();
                 $('#email').prop('required', false);
                 $('#reg_num').prop('required', true);
             } else {
                 $('#email-field').show();
                 $('#reg-num-field').hide();
                 $('#reg_num').prop('required', false);
                 $('#email').prop('required', true);
             }
         });

         const togglePassword = document.querySelector('#togglePassword');
         const password = document.querySelector('#password');
         const togglePasswordIcon = document.querySelector('#togglePasswordIcon');

         togglePassword.addEventListener('click', function() {
             const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
             password.setAttribute('type', type);
             togglePasswordIcon.classList.toggle('bi-eye-slash');
             togglePasswordIcon.classList.toggle('bi-eye');
         });
     });
 </script>

 <!-- JS and logic for toastr alert -->
 <script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>
 <?php echo $__env->make('backend.layout.partials._toastr_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bceitdev/dev/mt-zita/viwawa/resources/views/backend/auth/partials/_alljs.blade.php ENDPATH**/ ?>