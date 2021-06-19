<?php 
$cache_buster=time();
?>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xss-filters@1.2.7/dist/xss-filters.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="../assets/js/inspinia.js"></script>
<script src="../assets/js/plugins/pace/pace.min.js"></script>
<script src="../assets/js/plugins/slimscroll/jquery.slimscroll-1.3.8.min.js"></script>

<!-- Chosen -->
<script src="../assets/js/plugins/chosen/chosen.jquery-1.8.7.js"></script>

<!-- JSKnob -->
<script src="../assets/js/plugins/jsKnob/jquery.knob.js"></script>

<!-- Input Mask-->
<script src="../assets/js/plugins/jasny/jasny-bootstrap-4.0.0.min.js"></script>

<!-- Data picker -->
<script src="../assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Switchery -->
<script src="../assets/js/plugins/switchery/switchery.js"></script>

<!-- IonRangeSlider -->
<script src="../assets/js/plugins/ionRangeSlider/ion.rangeSlider-2.3.1.min.js"></script>

<!-- iCheck -->
<script src="../assets/js/plugins/iCheck/icheck.min.js"></script>

<!-- Clockpicker -->
<script src="../assets/js/plugins/clockpicker/clockpicker.js"></script>

<!-- MENU -->
<script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="../assets/js/plugins/fullcalendar/moment.min.js"></script>
<!-- Date range picker -->
<script src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="../assets/js/plugins/toastr/toastr-2.1.4.min.js"></script>
<script src="../assets/js/plugins/mustache/mustache-3.1.0.min.js"></script>
<script src="../assets/js/plugins/select2/select2.full-4.0.12.min.js"></script>

<script src="../assets/js/validation/jquery.validationEngine.js"></script>
<script src="../assets/js/validation/jquery.validationEngine-en.js"></script>
<script src="../assets/js/validation/jquery.validate.min.js"></script>

<script src="../assets/js/custom/apiconfig.js?v=<?= $cache_buster ?>"></script>
<script src="../assets/js/custom/sidebar.js?v=<?= $cache_buster ?>"></script>
<script src="../assets/js/custom/common-functions.js?v=<?= $cache_buster ?>"></script>
<script src="../assets/js/custom/header.js?v=<?= $cache_buster ?>"></script>
<script src="../assets/js/plugins/dataTables/datatables.min.js?v=<?= $cache_buster ?>"></script>
<script src="../assets/js/plugins/steps/jquery.steps.min.js"></script>
<script src="../assets/js/custom/utils.js"></script>
<script src="../assets/js/plugins/multiselect/jquery.multi-select.js"></script>
<script src="../assets/js/plugins/easyAutocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="../assets/js/side-menu.js"></script>
<script>
  function xssClean(input) {
    return xssFilters.inHTMLData(input);
  }
</script>

<script>
  $(document).ready(function() {
    utils.getNotifications(true);
    setInterval(utils.getNotifications, 10000);
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
    $('#data-calendar .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      startDate: '-100y',
    });
    $('#dob-calendar .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      startDate: '-100y',
      endDate: '+0d',
    });
    $("body").click(function(e) {
      utils.getNotifications(true);
    });
  });
</script>

<script>
  (function() { let _render = Mustache.render; Mustache.render = function(template, view, partials) { view.helpers = utils.mustacheHelpers; return _render(template, view, partials); } })()

  //========AUTO LOGOUT CODE=============
  var logout_time = 1200000; //20 Minutes ,NOTE:1 minute = 60000 miliseconds
  var timer = 0;

  function set_interval() {

    timer = setInterval("auto_logout()", logout_time);

  }

  function reset_interval() {
    if (timer != 0) {
      clearInterval(timer);
      timer = 0;
      // second step: implement the timer again
      timer = setInterval("auto_logout()", logout_time);
      // completed the reset of the timer
    }

  }

  function auto_logout() {
    var url = $('#url').val();
    TRIFED.logout();
  }

  $(document).ready(function() {
    set_interval();
  });
  $(document).on("keyup click mousemove scroll", function() {
    reset_interval();
  });
 $(function () {
    $.validator.methods.date = function (value, element) {
        return this.optional(element) || moment(value, 'dd/mm/yyyy').isValid();
  };
});
  //========AUTO LOGOUT CODE END=========
</script>