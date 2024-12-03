<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mePlayer</title>
    <link rel="stylesheet" href="<?=STATIC_URL?>me_player/meplayer.css">
    <link rel="stylesheet" href="<?=STATIC_URL?>me_player/main.css">
</head>
<style >
    .body_container{
       width: 100%;
        height: 100%;
    }
    .body_bg .body_bg_img{
        position: fixed;
        float: left;
        margin-top: -80px;
        margin-left: 480px;
        transform: rotate(35deg);
        z-index: 9999999;
    }
    .meplayer-info-cover{

    }
    .meplayer-container .meplayer-info-cover{
        padding-right:0;
        margin-top: 630px;
        margin-left:374px;
        width: 150px;
        height: 150px;
        border: 10px solid #989898;
        background-color: transparent;
        border-radius: 90px;
        z-index: 999999;
        transform: translate(-50%, -50%) rotate(0deg);
    }


    .meplayer-container .meplayer-info-cover img{
        width: 140px;
        height: 140px;
        z-index: 999999;
    }

    .container{
        width:750px ;
        margin: 0 auto;

    }
    .container-bg{
        background: url('<?=STATIC_URL?>image/voice.gif');z-index: 9999!important;
    }
    .music_box{
        width: 100%;
        background: url('<?=STATIC_URL?>image/music.gif');
        z-index: 9999;
    }
    .word_list{
        width: 100%;
        margin: 0 auto;
        text-align: center;
        border: 2px dotted rgba(22, 155, 213, 1);
        background: url('<?=STATIC_URL?>image/cd.gif') no-repeat;
        background-size: 170%;
        background-position:-262px -300px;
        z-index: 9999;
    }
    .c_left{
       position: fixed;
       margin-left:-150px;
    }
    .c_left .img_item{
        width: 134px;
        height: 134px;
        background: url('<?=STATIC_URL?>image/round.png') repeat;

    }
    .c_right{
        position: fixed;
        margin-left:780px;
    }
    .c_right .img_item{
        width: 134px;
        height: 134px;
        background: url('<?=STATIC_URL?>image/round.png');

    }
</style>
<script>
    let angle = 0;
    let angle_img = 35;
    let roop_back = 0;
    setInterval(() => {
        angle += 4; // 每次旋转4度
        if(angle_img>75||roop_back==1){
           angle_img=angle_img-1;
            roop_back = 1;
            if(angle_img==36){
                roop_back =0;
            }
           console.log(angle_img);
        }else{
            angle_img=angle_img+1;
            console.log(angle_img);
        }
        $('.meplayer-info-cover').css({"transform":`translate(-50%, -50%) rotate(${angle}deg)`});
        $(".body_bg .body_bg_img").css({"transform":`rotate(${angle_img}deg)`});
    }, 50); // 每0.02秒旋转一次
    $(".meplayer-container").addClass('meplayer-haslrc').removeClass('meplayer-isplaying');
</script>
<body onclick="body_click()" class="body_container">
<div class="music_box">
<div class="body_bg">
<img src="<?=STATIC_URL?>image/guitar.png" class="body_bg_img">

<div class="container-bg">
    <div class="container">
    <div class="c_left">
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
    </div>
    <div class="c_right">
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
        <div class="img_item"></div>
    </div>
    <div>
        <div class="music" ></div>
        <table id="word_list" class="word_list">

        </table>
    </div>
    </div>
    </div>


</div>

</div>
<script src="<?=STATIC_URL?>me_player/meplayer.js"></script>
<script src="<?=STATIC_URL?>/jquery.min.js"></script>
<script >
    var lrc = `
[00:00.80]情人
[00:02.31]作词：刘卓辉 作曲：黄家驹
[00:07.34]演唱：Beyond
[00:09.55]
[00:33.72]盼望你没有为我又再渡暗中淌泪
[00:40.25]我不想留底 你的心空虚
[00:46.75]盼望你别再让我象背负太深的罪
[00:53.66]我的心如水 你不必痴醉
[00:59.40]哦 你可知谁甘心归去
[01:06.86]你与我之间有谁
[01:12.26]
[01:13.55]是缘是情是童真 还是意外
[01:20.17]有泪有罪有付出 还有忍耐
[01:26.85]是人是墙是寒冬 藏在眼内
[01:33.67]有日有夜有幻想 没法等待
[01:39.90]
[01:53.76]盼望我别去后会共你在远方相聚
[02:00.39]每一天望海 每一天相对
[02:06.95]盼望你现已没有让我别去的恐惧
[02:13.63]我即使离开 你的天空里
[02:19.39]哦 你可知谁甘心归去
[02:26.99]你与我之间有谁
[02:33.02]
[02:33.65]是缘是情是童真 还是意外
[02:40.23]有泪有罪有付出 还有忍耐
[02:46.88]是人是墙是寒冬 藏在眼内
[02:53.51]有日有夜有幻想 没法等待
[02:59.77]
[03:27.44]多少春秋风雨改
[03:30.73]多少崎岖不变爱
[03:33.92]多少唏嘘的你在人海
[03:39.75]
[03:43.49]是缘是情是童真 还是意外
[03:50.12]有泪有罪有付出 还有忍耐
[03:56.75]是人是墙是寒冬 藏在眼内
[04:03.42]有日有夜有幻想 没法等待
[04:10.12]
    `;
    mePlayer({
        music: {
            src: '<?=$form['url']?>',
            title: '信念',
            author: 'beyond',
            loop: true,
            cover: '<?=STATIC_URL?>me_player/beyond.jpg',
            lrc:lrc,
        },
        target: '.music',
        autoplay: true
    })

    window.setTimeout(mePlayer.play, 1500)
    const audioDom = document.querySelector('.container audio')
    audioDom && audioDom.click() // 【主要代码 - 解决报错】先模拟与页面进行交互，防止报错
    audioDom && audioDom.play() // 播放音频

    function body_click(){
        console.log('aaaaaaaaaaa');
        $('.icon-play').trigger("click");
    }

</script>
</body>

<script>
    // 最开始获取到的歌词列表是字符串类型（不好操作）
    let lrcArr = lrc.split('\n');
    $.each(lrcArr,function (i,v) {
        var word_list_tr = '<tr><td>'+v+'</td></tr>';
        $('#word_list').append(word_list_tr);
    })
    var tr_time =0;
    setInterval(function() {
        tr_time = tr_time+3000;
        tr_time_td = tr_time/3000;
        console.log('继续输出');
        $.each( $('#word_list').find('tr'),function (i,v){

            $('#word_list').find('tr').eq(tr_time_td).css({"background-color":'rgb(22, 155, 213, 1)','color':'#ffffff'});
            $('#word_list').find('tr').eq(tr_time_td).siblings().css({"background-color":'transparent','color':'black'})
        })
    }, 5000);
</script>
</html>
