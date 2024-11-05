<!-- 引入多语言切换的js -->
<script src="<?=STATIC_URL?>js/translate.js"></script>
<script>
    translate.language.setLocal('chinese_simplified');
    translate.selectLanguageTag.show = false; //不出现的select的选择语言
    translate.service.use('client.edge'); //设置机器翻译服务通道
    translate.execute();
</script>
