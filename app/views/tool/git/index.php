<html>
<head>
    <title id="title_id" style="color: red;"></title>
</head>

<body  class="random-background">
<form action="" method="get" enctype="multipart/form-data" id="form" style="width: 1000px;height: 1000px;" onsubmit="return false;">
    <div >
        <input placeholder="git执行目录" class="form-control" name="path" id="path" value="/www/git_test" type="text" style="color:yellow;text-align:center;background:url(http://127.0.0.1/static/admin/images/git_bg/1.jpg);width: 1000px;height: 40px;border: 2px dotted red;font-size: 30px;font-weight:bold; border-radius: 5px;">
    </div>
    <div>
    <div style="margin: 0 auto;">
        <button id="btn_git_cmd" name="" class="btn-primary">执行git命令</button>
    </div>
    <textarea type="text" name="cmd" id="cmd" style="width: 1000px;height: 400px;border: 1px solid #1278f6;background-color:#0C0C0C;color: #FFFFFF;font-size: 24px;font-weight: bold;"></textarea>
    <br/>
    <table style="width:1000px;border: 3px dotted red" class="">
        <tr class="tr_line"><td>git init                                        </td><td>初始化本地git仓库（创建新仓库）</td></tr>
        <tr class="tr_line"><td>git config --global user.name "xxx"             </td><td>配置用户名</td></tr>
        <tr class="tr_line"><td>git config --global user.email "xxx@xxx.com"    </td><td>配置邮件</td></tr>
        <tr class="tr_line"><td>git config --global color.ui true               <td>git status等命令自动着色</td></tr>
        <tr class="tr_line"><td>git config --global color.status auto</td><td>git status等命令自动着色</td></tr>
        <tr class="tr_line"><td>git config --global color.diff auto</td><td>git 文件比较颜色</td></tr>
        <tr class="tr_line"><td>git config --global color.branch auto</td><td>git分支颜色</td></tr>
        <tr class="tr_line"><td>git config --global color.interactive auto</td><td>git颜色继承</td></tr>
        <tr class="tr_line"><td>git config --global --unset http.proxy          </td><td>remove  proxy configuration on git</td></tr>
        <tr class="tr_line"><td>git clone git+ssh://git@192.168.53.168/VT.git   </td><td>clone远程仓库</td></tr>
        <tr class="tr_line"><td>git status                                      </td><td>查看当前版本状态（是否修改）</td></tr>
        <tr class="tr_line"><td>git add xyz                                     </td><td>添加xyz文件至index</td></tr>
        <tr class="tr_line"><td>git add .                                       </td><td>增加当前子目录下所有更改过的文件至index</td></tr>
        <tr class="tr_line"><td>git commit -m 'xxx'                             </td><td>提交</td></tr>
        <tr class="tr_line"><td>git commit --amend -m 'xxx'                     </td><td>合并上一次提交（用于反复修改）</td></tr>
        <tr class="tr_line"><td>git commit -am 'xxx'                            </td><td>将add和commit合为一步</td></tr>
        <tr class="tr_line"><td>git rm xxx                                      </td><td>删除index中的文件</td></tr>
        <tr class="tr_line"><td>git rm -r *                                     </td><td>递归删除</td></tr>
        <tr class="tr_line"><td>git log                                         </td><td>显示提交日志</td></tr>
        <tr class="tr_line"><td>git log -1                                      </td><td>显示1行日志 -n为n行</td></tr>
        <tr class="tr_line"><td>git log -5</td><td>git日志显示前5行</td></tr>
        <tr class="tr_line"><td>git log --stat                                  </td><td>显示提交日志及相关变动文件</td></tr>
        <tr class="tr_line"><td>git log -p -m</td><td>git日志</td></tr>
        <tr class="tr_line"><td>git show dfb02e6e4f2f7b573337763e5c0013802e392818        </td><td> # 显示某个提交的详细内容</td></tr>
        <tr class="tr_line"><td>git show dfb02                                  </td><td>可只用commitid的前几位</td></tr>
        <tr class="tr_line"><td>git show HEAD                                   </td><td>显示HEAD提交日志</td></tr>
        <tr class="tr_line"><td>git show HEAD^                                  </td><td>显示HEAD的父（上一个版本）的提交日志 ^^为上两个版本 ^5为上5个版本</td></tr>
        <tr class="tr_line"><td>git tag                                         </td><td>显示已存在的tag</td></tr>
        <tr class="tr_line"><td>git tag -a v2.0 -m 'xxx'                        </td><td>增加v2.0的tag</td></tr>
        <tr class="tr_line"><td>git show v2.0                                   </td><td>显示v2.0的日志及详细内容</td></tr>
        <tr class="tr_line"><td>git log v2.0                                    </td><td>显示v2.0的日志</td></tr>
        <tr class="tr_line"><td>git diff                                        </td><td>显示所有未添加至index的变更</td></tr>
        <tr class="tr_line"><td>git diff --cached                               </td><td>显示所有已添加index但还未commit的变更</td></tr>
        <tr class="tr_line"><td>git diff HEAD^                                  </td><td>比较与上一个版本的差异</td></tr>
        <tr class="tr_line"><td>git diff HEAD -- ./lib                          </td><td>比较与HEAD版本lib目录的差异</td></tr>
        <tr class="tr_line"><td>git diff origin/master..master                  </td><td>比较远程分支master上有本地分支master上没有的</td></tr>
        <tr class="tr_line"><td>git diff origin/master..master --stat           </td><td>只显示差异的文件，不显示具体内容</td></tr>
        <tr class="tr_line"><td>git remote add origin git+ssh://git@192.168.53.168/VT.git</td><td> 增加远程定义（用于push/pull/fetch）</td></tr>
        <tr class="tr_line"><td>git branch                                      </td><td>显示本地分支</td></tr>
        <tr class="tr_line"><td>git branch --contains 50089                     </td><td>显示包含提交50089的分支</td></tr>
        <tr class="tr_line"><td>git branch -a                                   </td><td>显示所有分支</td></tr>
        <tr class="tr_line"><td>git branch -r                                   </td><td>显示所有原创分支</td></tr>
        <tr class="tr_line"><td>git branch --merged                             </td><td>显示所有已合并到当前分支的分支</td></tr>
        <tr class="tr_line"><td>git branch --no-merged                          </td><td>显示所有未合并到当前分支的分支</td></tr>
        <tr class="tr_line"><td>git branch -m master master_copy                </td><td>本地分支改名</td></tr>
        <tr class="tr_line"><td>git checkout -b master_copy                     </td><td>从当前分支创建新分支master_copy并检出</td></tr>
        <tr class="tr_line"><td>git checkout -b master master_copy              </td><td>上面的完整版</td></tr>
        <tr class="tr_line"><td>git checkout features/performance               </td><td>检出已存在的features/performance分支</td></tr>
        <tr class="tr_line"><td>git checkout --track hotfixes/BJVEP933          </td><td>检出远程分支hotfixes/BJVEP933并创建本地跟踪分支</td></tr>
        <tr class="tr_line"><td>git checkout v2.0                               </td><td>检出版本v2.0</td></tr>
        <tr class="tr_line"><td>git checkout -b devel origin/develop            </td><td>从远程分支develop创建新本地分支devel并检出</td></tr>
        <tr class="tr_line"><td>git checkout -- README                          </td><td>检出head版本的README文件（可用于修改错误回退）</td></tr>
        <tr class="tr_line"><td>git merge origin/master                         </td><td>合并远程master分支至当前分支</td></tr>
        <tr class="tr_line"><td>git cherry-pick ff44785404a8e                   </td><td>合并提交ff44785404a8e的修改</td></tr>
        <tr class="tr_line"><td>git push origin master                          </td><td>将当前分支push到远程master分支</td></tr>
        <tr class="tr_line"><td>git push origin :hotfixes/BJVEP933              </td><td>删除远程仓库的hotfixes/BJVEP933分支</td></tr>
        <tr class="tr_line"><td>git push --tags                                 </td><td>把所有tag推送到远程仓库</td></tr>
        <tr class="tr_line"><td>git fetch                                       </td><td>获取所有远程分支（不更新本地分支，另需merge）</td></tr>
        <tr class="tr_line"><td>git fetch --prune                               </td><td>获取所有原创分支并清除服务器上已删掉的分支</td></tr>
        <tr class="tr_line"><td>git pull origin master                          </td><td>获取远程分支master并merge到当前分支</td></tr>
        <tr class="tr_line"><td>git mv README README2                           </td><td>重命名文件README为README2</td></tr>
        <tr class="tr_line"><td>git reset --hard HEAD                           </td><td>将当前版本重置为HEAD（通常用于merge失败回退）</td></tr>
        <tr class="tr_line"><td>git rebase</td><td></td></tr>
        <tr class="tr_line"><td>git branch -d hotfixes/BJVEP933                 </td><td>删除分支hotfixes/BJVEP933（本分支修改已合并到其他分支）</td></tr>
        <tr class="tr_line"><td>git branch -D hotfixes/BJVEP933                 </td><td>强制删除分支hotfixes/BJVEP933</td></tr>
        <tr class="tr_line"><td>git ls-files                                    </td><td>列出git index包含的文件</td></tr>
        <tr class="tr_line"><td>git show-branch                                 </td><td>图示当前分支历史</td></tr>
        <tr class="tr_line"><td>git show-branch --all                           </td><td>图示所有分支历史</td></tr>
        <tr class="tr_line"><td>git whatchanged                                 </td><td>显示提交历史对应的文件修改</td></tr>
        <tr class="tr_line"><td>git revert dfb02e6e4f2f7b573337763e5c0013802e392818      </td><td># 撤销提交dfb02e6e4f2f7b573337763e5c0013802e392818</td></tr>
        <tr class="tr_line"><td>git ls-tree HEAD                               </td><td>内部命令：显示某个git对象</td></tr>
        <tr class="tr_line"><td>git rev-parse v2.0                              </td><td>内部命令：显示某个ref对于的SHA1 HASH</td></tr>
        <tr class="tr_line"><td>git reflog                                      </td><td>显示所有提交，包括孤立节点</td></tr>
        <tr class="tr_line"><td>git show HEAD@{5}</td><td>显示头 HEAD@{5}</td></tr>
        <tr class="tr_line"><td>git show master@{yesterday}                     </td><td>显示master分支昨天的状态</td></tr>
        <tr class="tr_line"><td>git log --pretty=format:'%h %s' --graph         </td><td>图示提交日志</td></tr>
        <tr class="tr_line"><td>git show HEAD~3</td><td>显示HEAD~3</td></tr>
        <tr class="tr_line"><td>git show -s --pretty=raw 2be7fcb476</td><td></td></tr>
        <tr class="tr_line"><td>git stash                                       </td><td>暂存当前修改，将所有至为HEAD状态</td></tr>
        <tr class="tr_line"><td>git stash list                                  </td><td>查看所有暂存</td></tr>
        <tr class="tr_line"><td>git stash show -p stash@{0}                     </td><td>参考第一次暂存</td></tr>
        <tr class="tr_line"><td>git stash apply stash@{0}                       </td><td>应用第一次暂存</td></tr>
        <tr class="tr_line"><td>git grep "delete from"                          </td><td>文件中搜索文本“delete from”</td></tr>
        <tr class="tr_line"><td>git grep -e '#define' --and -e SORT_DIRENT</td><td>git搜索指定字符串</td></tr>
        <tr class="tr_line"><td>git gc</td><td>git回收</td></tr>
        <tr class="tr_line"><td>git fsck</td><td>git检测</td></tr>
    </table>

</form>



<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script  src="<?=STATIC_URL?>js/layer/layer.js"></script>
<script>
    var message = {
        time: 0,
        title: document.title,
        timer: null,
        // 显示新消息提示
        show: function () {
            var title = message.title.replace("【　　　】", "").replace("【执行git命令思考中...】", "");
            // 定时器，设置消息切换频率闪烁效果就此产生
            message.timer = setTimeout(function () {
                message.time++;
                message.show();
                if (message.time % 2 == 0) {
                    document.title = "【执行git命令思考中...】" + title
                }

                else {
                    document.title = "【　　　】" + title
                };
            }, 600);
            return [message.timer, message.title];
        },
        // 取消新消息提示
        clear: function () {
            clearTimeout(message.timer);
            document.title = message.title;
        }
    };
    message.show();
</script>
<template id="btn_get_cmd_result_sel">
    <script>

        // function bg_sprit(){
        //     const btn_git_cmd_result_sel = $("#btn_git_cmd_result");
        //     let isVisible = true;function blink() {
        //         if (isVisible) {
        //             btn_git_cmd_result_sel.css("opacity",0.8);
        //         }else {
        //             btn_git_cmd_result_sel.css("opacity",1);
        //         }
        //         isVisible = !isVisible;
        //     }
        //     setInterval(blink, 500); // 每500毫秒切换一次可见性
        // }
        // bg_sprit();
        function changeColor() {
            var color="#f00|#0f0|#00f|#880|#808|#088|yellow|green|blue|gray";
            color=color.split("|");
            $("#btn_git_cmd_result").css("color",color[parseInt(Math.random() * color.length)]);
        }
        setInterval("changeColor()",400);
    </script>

</template>


<style>
    .btn-primary {
        color: #fff;
        background-color: #3280fc;
        border: 3px dotted red;
        width: 1000px;
        height: 50px;
        border-radius: 10px; /* 所有角都有10像素的圆角 */
    }
    .tr_line{
        border: 1px dotted red;
        background-color:#1278f6;
        color:#FFFFFF;
    }
    .random-background{
        width: 1000px;
        background: url("http://127.0.0.1/static/admin/images/git_bg/1.jpg");
        height: 100%;

    }
</style>

<script>

    $(document).ready(function() {
        $("#cmd").keydown(function(e) {
            var curKey = e.which;
            if (curKey === 'Backspace' ||curKey === 8) {
                $('#btn_git_cmd').html('执行git命令');
            }
            if (curKey == 13) {
                $('#btn_git_cmd').click();
                $('#btn_git_cmd').html("执行git命令"+ $('#cmd').val()+"思考中...");
                //  return false;
            }
        });
    });

    $('#btn_git_cmd').click(function () {
        var cmd = $('#cmd').val().split('\n');
        var path = $('#path').val();
        $('#btn_git_cmd').html("执行git命令"+ $('#cmd').val()+"思考中...");
        $.ajax({
            type: 'POST',
            url: '/tool/git/command?cmd='+cmd+'&path='+path,
            data: [],
            dataType: 'json',
            success: function (data) {
                layer.close(2);
                console.log(data);
                if(data.status==0){
                    $('#btn_git_cmd').html('执行git命令'+$('#cmd').val()+"思考结果...");
                    var content =  '<div  style="background:url(http://127.0.0.1/static/admin/images/git_bg/1.jpg) ; width: 1000px;height:1000px;">' +
                        ' <button id="btn_git_cmd_result" name="" class="btn-primary" style="width: 890px;font-size: 30px;background:url(http://127.0.0.1/static/admin/images/git_bg/1.jpg) ;">git命令执行结果</button>'+
                        '<table style="width: 100%;color: yellow ;"><tr style="border: 1px dotted #FFFFFF;background-color:#1278f6; ">' +
                        '<td>行号</td><td>信息</td></tr>'+
                        '<tr style="background:#000000"><td>'+'执行命令'+'</td><td>'+data.msg.cmd+'</td></tr>';
                    console.log(data.data);
                    $.each(data.data,function (i,v) {
                        console.log(v);
                        content = content+"<tr style='border: 1px dotted #FFFFFF;background-color:#1278f6; '><td>"+i+"</td><td>"+":"+v+"</td></tr>";
                    })
                    content = content+'</table></div>';
                    var image_id = Math.floor(Math.random() * 8);
                    content = content.replace('git_bg/1.jpg','git_bg/'+image_id+'.jpg')
                    console.log(content);
                    content = content+$('#btn_get_cmd_result_sel').html();
                    layer.open({
                        type: 1,
                        title: '',
                        offset: ['0px', '1010px'],
                        skin: 'layui-anim layui-anim-rl layui-layer-adminRight',
                        closeBtn: 0,
                        content: content,
                        shadeClose: true,
                        area: ['100%', '1000px'],
                        end: function(){


                            // rand_bg(iamge_id);
                            // console.log("层加载完成，包括CSS3动画");
                            // // 在这里执行你需要的操作
                        }
                    });
                    let op_width = $('.layui-anim-rl').outerWidth();
                    $('.layui-layer-shade').off('click').on('click', function () {
                        $('.layui-anim-rl').animate({left:'+='+op_width+'px'}, 300, 'linear', function () {
                            $('.layui-anim-rl').remove()
                            $('.layui-layer-shade').remove()
                        })

                    });
                }
            }
        });

    });

</script>

</body>

</html>