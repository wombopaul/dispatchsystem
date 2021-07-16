<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}
?>


.cmn--btn, .banner__content .banner__btn__grp a:nth-of-type(even):hover, .special__feature:hover .special__feature-icon, .section__cate, .about__item:hover .about__item-icon, .section__cate::before, .faq__item.open .faq__title, .post__item .post__date, .owl-dots .owl-dot span, .owl-dots .owl-dot.active, .brance__item .title::after, .social-icons li a:hover, .scrollToTop, .order-track-form-group button{
    background: <?php echo $color ?>;
}

.header-contact-info li a:hover, .header-contact-info i, .banner__content .banner__subtitle, .special__feature-icon, .about__item-icon, .service__item-content-title,.service__item:hover .service__item-content .service__item-content-title, .counter-item .counter-header .title, .post__item .post__content .post__meta .item i, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .footer__widget-contact li i, .footer__widget .useful-link li a::before, .hero__content .breadcrumb li, .widget__post .widget__post__content span {
    color: <?php echo $color ?>
}

.text--base {
    color: <?php echo $color ?> !important;
}


.special__feature-icon, .about__item-icon {
    border: 4px solid <?php echo $color ?>33;
    
}

.owl-dots .owl-dot{
     border: 4px solid <?php echo $color ?>;
}

.post__item .post__content a {
    background-image: linear-gradient(transparent calc(100% - 2px), <?php echo $color ?> 2px);
}


a {
    color:  <?php echo $color ?>;
}

.service__item {
    background: <?php echo $color ?>1a;
    border: 1px solid <?php echo $color ?>4d;
}
