<input type="hidden" id="id" value="<?=$form['id']?>">
<div class="zTreeDemoBackground left">
    <ul id="treeDemo" class="ztree"></ul>
</div>
<script>
    window.zNodes = <?=$menu_data?>;
    window.group_mids = {};
</script>
<script src="<?= STATIC_URL ?>js/jquery.min.js"></script>
<link rel="stylesheet" href="<?= STATIC_URL ?>js/ztree/css/metroStyle/metroStyle.css" type="text/css">
<script src="<?= STATIC_URL ?>js/ztree/js/jquery.ztree.core.js"></script>
<script src="<?= STATIC_URL ?>js/ztree/js/jquery.ztree.excheck.js"></script>
<script src="<?= STATIC_URL ?>js/ztree/js/jquery.ztree.exedit.js"></script>
<script src="<?= STATIC_URL ?>js/logic/admin/group/tree.js?<?php echo rand();?>"></script>

