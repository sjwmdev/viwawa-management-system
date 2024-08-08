<?php $__env->startSection('js'); ?>

<!-- DataTables JS -->
<script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

<script>
    $(function() {
        // Assuming that you pass the dynamic title as a meta tag or through a global JS variable
        var reportTitle = $('meta[name="report-title"]').attr('content') || 'Ripoti ya Mfumo wa Viwawa';
        
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export to Excel',
                    title: '', // Leave the title blank to prevent default title behavior
                    exportOptions: {
                        columns: ':visible:not(.not-printable)' 
                    },
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var rows = $('row', sheet);
                        
                        // Add custom header with title and date
                        var date = new Date().toLocaleDateString('en-US', { day: '2-digit', month: 'short', year: 'numeric' });
                        var customHeader = `
                            <row r="1">
                                <c t="inlineStr" r="A1">
                                    <is><t>${reportTitle}</t></is>
                                </c>
                                <c t="inlineStr" r="B1">
                                    <is><t>${date}</t></is>
                                </c>
                            </row>
                        `;
                        rows.first().before(customHeader);
                    }
                },
                {
                    extend: 'print',
                    text: 'Chapisha Ripoti',
                    title: '', // Leave the title blank to prevent default title behavior
                    exportOptions: {
                        columns: ':visible:not(.not-printable)' 
                    },
                    customize: function (win) {
                        var currentDate = new Date();
                        var formattedDate = currentDate.toLocaleDateString('en-US', { day: '2-digit', month: 'short', year: 'numeric' });
                        
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<div style="text-align: center; margin-bottom: 20px;">' +
                                '<img src="<?php echo e(asset('logo/viwawa_logo.svg')); ?>" style="height: 50px; margin-bottom: 30px" />' +
                                '<div style="font-size: 16pt; font-weight: bold;">' + reportTitle + '</div>' +
                                '<div>' + formattedDate + '</div>' +
                                '</div>'
                            )
                            .append(
                                '<div style="position: fixed; bottom: 0; width: 100%; text-align: center; margin-bottom: 30px">' + formattedDate + '</div>'
                            );

                        var table = $(win.document.body).find('table')
                            .addClass('compact')
                            .css({
                                'font-size': 'inherit',
                                'width': '100%',
                                'border': '1px solid #ddd',
                                'border-collapse': 'collapse',
                            });

                        table.find('thead th')
                            .css({
                                'background-color': '#dfe1e4',
                                'color': '#333',
                                'border': '1px solid #ddd',
                                'text-align': 'center'
                            });
                        
                        table.find('tbody td')
                            .css({
                                'border': '1px solid #ddd',
                                'text-align': 'center'
                            });

                        // Set the document title to avoid "about:blank"
                        $(win.document.head).find('title').text('');
                    }
                }
            ]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/components/index/alljs.blade.php ENDPATH**/ ?>