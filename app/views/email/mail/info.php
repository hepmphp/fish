<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppAsset::run()?>
</head>
<style>
    .bd_line{
        border: 3px solid #1278f6;
    }
    .bd_line_l{
        border-right: 3px solid #1278f6;
    }
</style>
<body>
<div class="container col-sm-12" style="margin-top: 10px;background:url('<?=STATIC_URL?>images/mail_bg.gif') no-repeat;background-size: cover;">
    <div class="form-horizontal" style="margin-top: 200px;line-height:20px;margin-left: 50px;">
        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="title">收件人</label>
            <div class="col-sm-4">
                <p><?=$form['to']?></p>
            </div>
        </div>

        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="title">标题</label>
            <div class="col-sm-4">
                <p><?=$form['subject']?></p>
            </div>
        </div>
        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l " for="title">发件人</label>
            <div class="col-sm-4">
                <p><?=$form['from']?></p>
            </div>
        </div>
        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="tag_ids">邮件日期</label>
            <div class="col-sm-4">
                <p><?=$form['MailDate']?></p>
            </div>
        </div>

        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="keywords">邮件大小</label>
            <div class="col-sm-4">
                <p><?=$form['Size']?></p>
            </div>
        </div>
        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="keywords">附件</label>
            <div class="col-sm-4">
                <?=$form['attach']?>
            </div>
        </div>
        <!-- Textarea -->
        <div class="form-group bd_line">
            <label class="col-sm-2 control-label bd_line_l" for="tag_ids">邮件内容</label>
            <?php if(strpos($form['body'],'>')!=false){ ?>
                <?=$form['body']?>
            <?php }else{ ?>
           <textarea style=" width:600px; height:500px;border: 1px dotted #1278f6"><?=$form['body']?></textarea>
            <?php }?>
        </div>



    </div>
</div>



</body>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</html>