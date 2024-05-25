<!-- <script src="/temp/build/js/main.min.js"></script> -->
{{-- <script src="/temp/build/js/validate.min.js"></script> --}}
<script src="/temp/assets/js/validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/temp/js/main.js"></script>
<script src="/temp/assets/js/bootstrap.min.js"></script>
<script src="/temp/assets/js/wow.min.js"></script>
<script src="/temp/assets/js/tiny-slider.js"></script>
<script src="/temp/assets/js/glightbox.min.js"></script>
<script src="/temp/assets/js/main.js"></script>
<!-- <script src="/temp/build/js/main.min.js"></script> -->
<script type="text/javascript">

    // $('.add-to-cart').on('click',function(){
    //     window.location.reload();
    // })
    //========= Category Slider
    tns({
        container: '.category-slider',
        items: 3,
        slideBy: 'page',
        autoplay: false,
        mouseDrag: true,
        gutter: 0,
        nav: false,
        controls: true,
        controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 2,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1170: {
                items: 6,
            }
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
