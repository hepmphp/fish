function call_debug_log() {
    console.log('allow pasting');
    $.getJSON('/api/user/get_debug?' + $.param(param), function (data) {
        debug_log(data.data);

    })
    function debug_log(data) {
        $('body').after();
        if (data.debug.console_log != undefined) {
            $('body').after(data.debug.console_log);
        }
        if (data.debug.console_log_table) {
            $('body').after(data.debug.console_log_table);
        }
    }
}
call_debug_log();