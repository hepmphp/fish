/* 分页 */
function multi(num, perpage,curpage,maxpages) {
    var multipage = '';
    if (num > perpage) {
        var page = 9;
        var offset = 2;
        var realpages = Math.ceil(num/perpage);//总共多少页
        var pages = maxpages && maxpages < realpages ? maxpages : realpages;//最大分页数

        if (page > pages) {
            var from = 1;
            var to = pages;
        } else {
            from = curpage -offset;//当前页-偏移量
            to = from + page - 1;
            if (from < 1) {//第一页
                to = curpage + 1 -from;
                from = 1;
                if (to - from<page) {
                    to = page;
                }
            } else if (to > pages) {
                from = pages - page + 1;
                to = pages;
            }
        }
        if(curpage===undefined ||curpage.length===0 ||curpage===null||(typeof value === 'string' && value.trim() === '') )
        {
            curpage=1;
        }
        multipage += (curpage > 1 ? '<li class="page-pre"><a data-page="'+(curpage-1)+'">上一页</a></li>' : '<li class="page-pre"><a href="javascript:void(0)" data-page="1">上一页</a></li>');

        for (i = from; i <= to; i++) {
            multipage += i == curpage ? '<li class="page-number active"><a data-page="'+i+'">'+i+'</a></li>' :'<li class="page-number"><a  data-page="'+i+'">'+i+'</a></li>';
        }
        multipage += (curpage <pages ? '<li class="page-next"><a data-page="'+(curpage + 1)+'">下一页</a></li>' : '');
    }
    return multipage;
}