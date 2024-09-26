<!-- Favicon -->
<link rel="icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon">

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/custom.min.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- CSS toastr alert -->
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.css')); ?>">

<style>
    .login-page {
        background: linear-gradient(135deg, var(--blue-whale), var(--cornflower), var(--dodger-blue), var(--mystic-grey), var(--teal-blue));
        background-size: 600% 600%;
        animation: gradientAnimation 20s ease infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
        background-attachment: fixed; /* Ensure the background image stays fixed */
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 0%;
        }
        25% {
            background-position: 100% 0%;
        }
        50% {
            background-position: 100% 100%;
        }
        75% {
            background-position: 0% 100%;
        }
        100% {
            background-position: 0% 0%;
        }
    }

    .login-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('<?php echo e(asset('images/bg/svg/bg-13.svg')); ?>'); /* Path to the bg pattern image */
        background-size: cover;
        background-repeat: no-repeat;
        opacity: 0.3;
        z-index: 0;
        pointer-events: none; /* Ensure the image does not interfere with user interaction */
    }

    .login-box {
        width: 90%;
        max-width: 400px;
        margin: 20px;
        position: relative;
        z-index: 1;
    }

    .register-box {
        width: 90%;
        max-width: 600px;
        margin: 20px;
        position: relative;
        z-index: 1;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: var(--matisse);
        color: white;
        text-align: center;
        font-size: 1.65rem;
        font-weight: bold;
    }

    .card-body {
        padding: 2rem;
    }

    .login-logo {
        max-width: 150px;
        margin-bottom: 1rem;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-floating input {
        width: 100%;
        padding: 1rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 5px;
        height: auto;
        outline: none;
        font-size: 1rem;
    }

    .form-floating label {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0 0.25rem;
        color: #888;
        pointer-events: none;
        transition: all 0.2s;
        background: white;
        font-size: 1rem;
    }

    .form-floating input:focus + label,
    .form-floating input:not(:placeholder-shown) + label {
        top: -0.75rem;
        left: 0.75rem;
        font-size: 0.85rem;
        color: var(--matisse);
    }

    .form-floating .input-group-text {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .btn-login {
        background-color: var(--matisse);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: background-color 0.3s;
        width: 100%;
    }

    .btn-login:hover {
        background-color: var(--tulip-tree);
    }

    .text-warning {
        color: var(--tulip-tree) !important;
    }

    .btn-group-toggle .btn {
        background-color: var(--matisse);
        border: 1px solid var(--matisse);
        color: white;
        transition: background-color 0.3s;
    }

    .btn-group-toggle .btn:hover,
    .btn-group-toggle .btn.active {
        background-color: var(--tulip-tree);
        border: 1px solid var(--tulip-tree);
        color: white;
    }
</style>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/auth/partials/_allcss.blade.php ENDPATH**/ ?>