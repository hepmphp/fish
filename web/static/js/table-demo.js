$('.table-item').bootstrapTable({
     height:$(".form-wrapper").height() - $(".form-item").height() - 70,
})
$('.table-item2').bootstrapTable({
     height:$(".form-wrapper").height() - $(".form-item").height() - 120,
});
$('#table-item3').bootstrapTable({
  height:$(".form-wrapper").height() - 160,
  showFooter: true,     
});
$('.chat-table').bootstrapTable({
     height:$(".form-wrapper").height() - 130,
});
 function sumFormatter(data) {
    field = this.field;
    return data.reduce(function(sum, row) { 
        return sum + (+row[field]);
    }, 0);
}/*实现汇总*/

/*充值对比表格*/
    $('#columns-table').bootstrapTable({
     url: 'js/demo/1.json',
       height:$(".form-wrapper").height() - 110,
          columns:[
        [
        {
        field: 'pingtai',
        title: '平台',
        valign:"middle",
        align:"center",
        colspan: 1,
        rowspan: 2
        },{
        field: 'date1',
        title: '1990-01-01到1990-01-07充值',
        colspan: 4,
        rowspan: 1
        },{
        field: 'date2',
        title: '1990-01-08到1990-01-14充值',
        colspan: 4,
        rowspan: 1
        }
        ],
        [
        {
        field: 'congzi_1',
        title: '充值'
        },
        {
        field: 'renum_1',
        title: '人数'
        },
        {
        field: 'renci_1',
        title: '人次'
        },
        {
        field: 'ARPU_1',
        title: 'ARPU'
        },
        {
        field: 'congzi_2',
        title: '充值'
        },
        {
        field: 'renum_2',
        title: '人数'
        },
        {
        field: 'renci_2',
        title: '人次'
        },
        {
        field: 'ARPU_2',
        title: 'ARPU'
        }
      ]
]
    });