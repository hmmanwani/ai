<!-- container-scroller -->
<script src="<?php echo e(URl('vendors/base/vendor.bundle.base.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<!-- Ensure correct order and URLs for intl-tel-input -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js"></script>
<script src="<?php echo e(URl('vendors/justgage/raphael-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(URl('vendors/justgage/justgage.js')); ?>"></script>
<script src="<?php echo e(URl('assets/js/jquery.cookie.js')); ?>" type="text/javascript"></script>
<!-- Custom js for this page-->

<script src="<?php echo e(URl('assets/js/jnoty.min.js')); ?>"></script>
<script src="<?php echo e(URl('assets/js/admin-datatable.js')); ?>"></script>

<script>
    // remove wide space
    $('.form-control').keyup(function() {
        if ($(this).attr('type') != 'password') {
            $val = $(this).val();
            $(this).val($val.trimStart());
        }
    });

    function baseUrl() {
        return '<?= URL('') ?>';
    }

    function csrf() {
        return '<?= csrf_token() ?>';
    }
    // scroll top show header
    $(document).ready(function() {
        var prevScrollpos = $(window).scrollTop();
        $(window).scroll(function() {
            var currentScrollPos = $(this).scrollTop();
            if (currentScrollPos < prevScrollpos) {
                $('.bottom-navbar').addClass('fixheadermenu');
                if (currentScrollPos == 0) {
                    $('.bottom-navbar').removeClass('fixheadermenu');
                }
            } else {
                $('.bottom-navbar').removeClass('fixheadermenu');
            }
            prevScrollpos = currentScrollPos;
        });
    });
</script>
<!-- End custom js for this page-->
<script>
    <?php if(session()->get('notification')) {
    $message = session()->get('notification');
  ?>
    notification('<?php echo e($message['type']); ?>', '', "<?php echo e($message['message']); ?>");
    <?php }  ?>

    function notification(theme, message, header = '') {
        if (header == '') {
            header = theme;
        }
        switch (theme) {
            case "success":
                $.jnoty(message, {
                    header: header,
                    sticky: false,
                    theme: 'jnoty-' + theme,
                    icon: 'fa fa-check-circle fa-2x',
                    delay: 5000,
                    position: 'bottom-left'
                });
                break;

            case "warning":
                $.jnoty(message, {
                    sticky: false,
                    header: header,
                    theme: 'jnoty-' + theme,
                    icon: 'fa fa-info-circle fa-2x',
                    delay: 5000,
                    position: 'bottom-left'
                });
                break;

            case "info":
                $.jnoty(message, {
                    sticky: false,
                    header: header,
                    theme: 'jnoty-' + theme,
                    icon: 'fa fa-info-circle fa-2x',
                    delay: 5000,
                    position: 'bottom-left'
                });
                break;

            case "danger":
                $.jnoty(message, {
                    sticky: true,
                    header: header,
                    theme: 'jnoty-' + theme,
                    icon: 'fa fa-info-circle fa-2x',
                    delay: 5000,
                    position: 'bottom-left'
                });
                break;

            default:
                $.jnoty(message, {
                    sticky: false,
                    header: header,
                    theme: 'jnoty-' + theme,
                    icon: 'fa fa-info-circle fa-2x',
                    delay: 5000,
                    position: 'bottom-left'
                });
        }
    }
</script>
<script>
  // Disable Right Click
  document.addEventListener("contextmenu", event => event.preventDefault());

  // Block DevTools shortcuts
  document.onkeydown = function(e) {
    if (
      e.key === "F12" ||
      (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) ||
      (e.ctrlKey && e.key === "U")
    ) {
      return false;
    }
  };

  // Detect DevTools open by checking window size changes
  setInterval(function () {
    const threshold = 160;
    if (window.outerWidth - window.innerWidth > threshold || window.outerHeight - window.innerHeight > threshold) {
      document.body.innerHTML = "<h1 style='color:red;text-align:center;'>DevTools are not allowed!</h1>";
    }
  }, 1000);
</script>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/components/footer.blade.php ENDPATH**/ ?>