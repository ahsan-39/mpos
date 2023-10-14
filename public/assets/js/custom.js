document.addEventListener('DOMContentLoaded', async function () {
    initDateRangePicker();
    Livewire.on('reset-daterangepicker', function () {
        initDateRangePicker();
    });
    Livewire.on('hideModal', function () {
        $("[data-dismiss=modal]").trigger({
            type: "click"
        });
    });
    $(document).on('click', '.btn_init_modal', function () {
        window.livewire.emit('reset-input-fields');
    });

    function initDateRangePicker() {
        $('#filter-date-range').daterangepicker({
            "autoApply": true,
            "startDate": moment().startOf('month').format('MM/DD/YYYY'),
            "endDate": moment().format('MM/DD/YYYY'),
            "maxDate": moment().format('MM/DD/YYYY')
        }, function (start, end, label) {
            window.livewire.emit('set-date-range', start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    }

    /**
     * Search Filters Bootstrap select
     */
    $(function () {
        $('.bt-select-picker').selectpicker();
    });
    Livewire.on('initSelectFilter', () => {
        $('.bt-select-picker').selectpicker();
    });
    Livewire.on('clear-select-filters', () => {
        $(".bt-select-picker").val("").selectpicker("refresh");
    });
});