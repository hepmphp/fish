<html>
<head>

</head>
<body>

</body>
<script src="<?=STATIC_URL?>js/ckfinder/ckfinder.js?<?=rand()?>"></script>
<script>
    var finder;

    CKFinder.start( {
        onInit: function( instance ) {
            finder = instance;
        }
    } );
</script>
</html>