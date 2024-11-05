<link rel="stylesheet" href="<?=STATIC_URL?>/js/swiper/css/swiper.css">
<link rel="stylesheet" href="<?=STATIC_URL?>/js/swiper/css/client.css">
<script src="<?=STATIC_URL?>/js/swiper/js/swiper.js"></script>
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($banner as $bn){?>
        <div class="swiper-slide"><img src="<?=$bn['image_url']?>" style="width: 1440px"></div>
        <?php }?>

    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        // autoplay: 3000,
        autoplayDisableOnInteraction: false
    });
</script>
