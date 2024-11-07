
var urls = {
    create_url:'/[path]/[table]/create',
    update_url:'/[path]/[table]/update',
    delete_url:'/[path]/[table]/delete',
    info_url:'/[path]/[table]/info'
};

/***
 * 添加
 */
function add(){
    var url = '/[path]/[table]/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/[path]/[table]/create?id="+id;
    layer_form(url,2,['900px', '600px']);
}

/***
 * * @param id
 */
function del(id) {
    layer.confirm('确定要删除?',{
            btn: ['确定','取消'], //按钮
            icon: 3,
            title:'提示'
        }, function(){
            ajax_post(urls.delete_url,{ids:id})
        },
        function(){

        }
    );
}

function info($id){
    var url = urls.info_url+"?id="+id;
    layer_form(url,1,['900px', '600px']);
}
//表单
function layer_form(url,action,area){
    var content = url;
    var title = action==2?'修改':'添加';
    var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
    layer.open({
        type: 2, //iframe
        maxmin: true,
        area:area ,
        title: title,
        btn: btn,
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:content,
        yes: function(index, layero){
            var body = layer.getChildFrame('body', index);
            var param ={
                [form_data]
            };
            //todo生成js验证
            if(param.id){
                var url = urls.update_url+'?id='+param.id;
            }else{
                var url = urls.create_url
            }
            ajax_post(url,param);

        },btn2: function(index, layero){

        }

    });
}