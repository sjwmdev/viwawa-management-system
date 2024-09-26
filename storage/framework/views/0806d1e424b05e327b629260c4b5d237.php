<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Welcome message after login -->
        <?php $__sessionArgs = ['success'];
if (session()->has($__sessionArgs[0])) :
if (isset($value)) { $__sessionPrevious[] = $value; }
$value = session()->get($__sessionArgs[0]); ?>
            <div class="row mt-0">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5 class="alert-heading">Karibu kwenye Dashibodi ya Msimamizi!</h5>
                    </div>
                </div>
            </div>
        <?php unset($value);
if (isset($__sessionPrevious) && !empty($__sessionPrevious)) { $value = array_pop($__sessionPrevious); }
if (isset($__sessionPrevious) && empty($__sessionPrevious)) { unset($__sessionPrevious); }
endif;
unset($__sessionArgs); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.details')): ?>
            <!-- Calendar -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h3 class="card-title">Ripoti ya Fedha za Michango ya Kila Mwezi</h3>
                        </div>
                        <div class="card-body">
                            <!-- Calendar goes here -->
                            <div id="calendar" style="width: 100%; height: 800px; margin: 0; padding: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fullcalendar/main.min.css')); ?>">
    <style>
        .card-body {
            padding: 0;
        }

        #calendar {
            background: #ffffff;
            border: 1px solid #d3d3d3;
            box-shadow: 0 2px 4px rgba(221, 218, 218, 0.1);
            border-radius: 5px;
            height: 100% !important;
        }

        .card-header {
            border-bottom: 1px solid #dee2e6;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .fc-toolbar {
            margin-bottom: 10px;
        }

        .fc-event {
            font-size: 1.2em;
            background-color: var(--mystic-grey);
            color: white;
            padding: 5px;
            border: 1px solid var(--mystic-grey);
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/fullcalendar/main.min.js')); ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: function(fetchInfo, successCallback, failureCallback) {
                    var events = [
                        <?php $__currentLoopData = $monthlyContributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                title: 'Kiasi: <?php echo e(number_format($contribution->total_amount, 0)); ?> TZS - Wanachama: <?php echo e($contribution->member_count); ?>',
                                start: '<?php echo e($contribution->month); ?>-01',
                                url: '<?php echo e(route('admin.monthly.contributions.details', ['year' => substr($contribution->month, 0, 4), 'month' => substr($contribution->month, 5, 2)])); ?>'
                                    .replace(/&amp;/g, '&')
                            },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ];
                    successCallback(events);
                },
                contentHeight: 'auto',
                eventDidMount: function(info) {
                    // Ensure no duplication of title
                    if (!info.el.classList.contains('title-processed')) {
                        var titleHtml = info.el.querySelector('.fc-event-title');
                        if (titleHtml) {
                            var lines = info.event.title.split(' - ');
                            titleHtml.innerHTML = lines.map(line => `<div>${line}</div>`).join('');
                        }
                        info.el.classList.add('title-processed');
                    }
                },
                eventClick: function(info) {
                    // Prevent the default browser behavior for clicking an event
                    info.jsEvent.preventDefault();

                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                }
            });
            calendar.render();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/dashboard.blade.php ENDPATH**/ ?>