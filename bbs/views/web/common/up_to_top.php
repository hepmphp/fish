<script>
    // 滚动到指定位置
    $.scrollTo = function (type, duration, options)
    {
        if (typeof type == 'object')
        {
            var type = $(type).offset().top
        }

        $('html, body').animate({
            scrollTop: type
        }, {
            duration: duration,
            queue: options.queue
        });
    }
</script>
<a class="aw-back-top hidden-xs" href="javascript:;" onclick="$.scrollTo(1, 600, {queue:true});" style="display: inline;"><i class="icon icon-up"></i></a>