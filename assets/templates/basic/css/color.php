<?php
header("Content-Type:text/css");
function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#003367";
}
?>



*::-webkit-scrollbar-button, *::-webkit-scrollbar-thumb, .scrollToTop, .cmn-btn-active:focus, .cmn-btn-active:hover, .cmn-btn, .border-btn.active, .border-btn:hover, .small-btn::after, .nice-select, .header-bottom-area .navbar-collapse .main-menu li a::after, .header-bottom-area .navbar-collapse .main-menu li .sub-menu li::before, .header-search-form .header-search-btn, .title-border::before, .title-border::after, .title-border-left::after, .banner-slider .banner-pagination span.swiper-pagination-bullet-active::after, .ruddra-next:hover, .ruddra-prev:hover, .choose-slider .swiper-pagination .swiper-pagination-bullet-active, .booking-item .booking-thumb .doc-deg, .booking-item .booking-thumb .fav-btn:hover, .booking-section-two .booking-tag li:hover a, .overview-booking-list .booked::before, .overview-booking-area .clearfix li a.disabled, .faq-wrapper .faq-item.open .right-icon::before, .faq-wrapper .faq-item.open .right-icon::after, .contact-form-area .contact-form .submit-btn, .contact-item-icon i, .blog-details-section .tag-item-wrapper .tag-item:hover, .comments-section .comment-item .comment-content:hover .reply-button i, .footer-form .submit-btn, .date-select, .date-select:focus, .bg-site-color, .card-header, .submit-button, .innercircle, ::selection, .banner-slider .swiper-pagination .swiper-pagination-bullet. .blog-item .blog-thumb .blog-cat {
    background-color: <?= $color ?>;
}

.pagination .page-item.active .page-link, .pagination .page-item:hover .page-link, .client-content::before, .file-upload-wrapper:before, .pagination .page-item.disabled span {
    background: <?= $color ?>;
}

.admin-reply-section{
  background-color: <?= $color ?>29;
}

.outercircle{
  background-color: <?= $color ?>90;
}

.scrollToTop:hover, .cmn-btn-active, .custom-btn:hover, .header-bottom-area .navbar-collapse .main-menu li.active a, .header-bottom-area .navbar-collapse .main-menu li:hover a, .language-select .nice-select span, .navbar-toggler span, .header-form .header-form-area button, .header-form .header-form-area input[type="button"], .header-form .header-form-area input[type="reset"], .header-form .header-form-area input[type="submit"], .breadcrumb li, .breadcrumb-item.active::before, .banner-slider .banner-pagination span.swiper-pagination-bullet-active, .ruddra-next, .ruddra-prev, .team-content .team-list li i, .client-content .client-icon i, .blog-item .blog-content .title:hover, .call-to-action-area .call-info .call-info-content .title a, .call-to-action-area .mail-info .mail-info-content .title a, .booking-item .booking-content .sub-title, .booking-item .booking-content .booking-list li span, .overview-tab-wrapper .tab-menu li.active, .booking-confirm-area .booking-confirm-list li span, .blog-details-section .category-content li:hover, .privacy-area p a, .ticket-button, .close-button, .text-color, .footer-social li a i:hover, .footer-contact li i, .footer-menus li a i {
    color: <?= $color ?>;
}

.footer-social li, .footer-social li a:hover, .footer-social li a.active, .cmn--text {
    color: <?= $color ?> !important;
}

.scrollToTop, .cmn-btn-active, .title-border-left::before, .ruddra-next, .ruddra-prev, .border-btn  {
    border: 1px solid <?= $color ?>;
}


.overview-content .overview-list li .overview-user .before-circle {
    border: 2px solid <?= $color ?>;
}

.cmn-btn-active:focus, .cmn-btn-active:hover, .cmn-btn:focus, .cmn-btn:hover {
    box-shadow: 0px 15px 20px -8px <?= $color ?>;
}

.header-bottom-area .navbar-collapse .main-menu li .sub-menu {
    border-left: 3px solid <?= $color ?>;
}

.search-bar a {
    border: 2px dashed <?= $color ?>;
}

.language-select .nice-select:after {
    border-color: <?= $color ?> transparent transparent;
}

.header-form .header-form-area input {
    border-bottom: 1px solid <?= $color ?>;
}

.overview-tab-wrapper .tab-menu li.active {
    border-bottom: 2px solid <?= $color ?>;
}

.pagination .page-item.active .page-link, .pagination .page-item:hover .page-link, .date-select, .date-select:focus {
  border-color: <?= $color ?>;
}

.payment-item .payment-badge{
    border-right: 60px solid <?= $color ?>;
}
