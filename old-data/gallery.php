<?php 
$title="Gallery";
include 'header.php';
?>


<div class="site-blocks-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-10">

                <div class="row justify-content-center mb-4">
                    <div class="col-md-10 text-center">
                        <h1 data-aos="fade-up" class="mb-5">We give solutions to your <span class="typed-words"></span></h1>

                        <p data-aos="fade-up" data-aos-delay="100"><a href="#" class="btn btn-primary btn-pill">Get Started</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <section id="lightbox_gallery " class="container gallery">
                <div class="row">
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/body-massage.jpg)" data-imgsrc="images/body-massage.jpg">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/body-massage.webp)" data-imgsrc="images/body-massage.webp">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/deep-tissue.webp)" data-imgsrc="images/deep-tissue.webp">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/female-to-female.webp)" data-imgsrc="images/female-to-female.webp">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/female-to-male.webp)" data-imgsrc="images/female-to-male.webp">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/group-massage.jpg)" data-imgsrc="images/group-massage.jpg">
                        </div>
                    </div>
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/home-massage.jpg)" data-imgsrc="images/home-massage.jpg">
                        </div>
                    </div>
                    
                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/male-to-female.webp)" data-imgsrc="images/male-to-female.webp">
                        </div>
                    </div>

                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/male-to-male.webp)" data-imgsrc="images/male-to-male.webp">
                        </div>
                    </div>

                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/massage-at-home.webp)" data-imgsrc="images/massage-at-home.webp">
                        </div>
                    </div>

                    <div class=" col-12 col-md-4 col-lg-3 p-3">
                        <div class="lightbox-enabled" style="background-image:url(images/massage-therapy.webp)" data-imgsrc="images/massage-therapy.webp">
                        </div>
                    </div>


                </div>
            </section>
            <section class="lightbox-container">
                <span class="material-icons-outlined lightbox-btn left circle1" id="left">
                <i class="fa fa-arrow-left"></i>
</span>
                <span class="material-icons-outlined lightbox-btn right circle1" id="right">
                <i class="fa fa-arrow-right"></i>
</span>
                <span class="close" id="close">&#10539;</span>
                <div class="lightbox-image-wrapper">
                    <img alt="lightboximage" class="lightbox-image">


                </div>
            </section>

        </div>
    </div>
</div>
<script>
    // Much of this code is not from me. I got a good chunk of the functionality from a tutorial I can't remember. I added the animations cause I'm tired of easy-to-implement galleries always looking dull. Thanks for looking! If you end up making any upgrades to the code, please let me know and I'll implement them here. Thanks!
    // query selectors
    const lightboxEnabled = document.querySelectorAll('.lightbox-enabled');
    const lightboxArray = Array.from(lightboxEnabled);
    const lastImage = lightboxArray.length - 1;
    const lightboxContainer = document.querySelector('.lightbox-container');
    const lightboxImage = document.querySelector('.lightbox-image');
    const lightboxBtns = document.querySelectorAll('.lightbox-btn');
    const lightboxBtnRight = document.querySelector('#right');
    const lightboxBtnLeft = document.querySelector('#left');
    const close = document.querySelector('#close');
    let activeImage;
    // Functions
    const showLightBox = () => {
        lightboxContainer.classList.add('active')
    }

    const hideLightBox = () => {
        lightboxContainer.classList.remove('active')
    }

    const setActiveImage = (image) => {
        lightboxImage.src = image.dataset.imgsrc;
        activeImage = lightboxArray.indexOf(image);
    }

    const transitionSlidesLeft = () => {
        lightboxBtnLeft.focus();
        $('.lightbox-image').addClass('slideright');
        setTimeout(function() {
            activeImage === 0 ? setActiveImage(lightboxArray[lastImage]) : setActiveImage(lightboxArray[activeImage - 1]);
        }, 250);


        setTimeout(function() {
            $('.lightbox-image').removeClass('slideright');
        }, 500);
    }

    const transitionSlidesRight = () => {
        lightboxBtnRight.focus();
        $('.lightbox-image').addClass('slideleft');
        setTimeout(function() {
            activeImage === lastImage ? setActiveImage(lightboxArray[0]) : setActiveImage(lightboxArray[activeImage + 1]);
        }, 250);
        setTimeout(function() {
            $('.lightbox-image').removeClass('slideleft');
        }, 500);
    }

    const transitionSlideHandler = (moveItem) => {
        moveItem.includes('left') ? transitionSlidesLeft() : transitionSlidesRight();
    }

    // Event Listeners
    lightboxEnabled.forEach(image => {
        image.addEventListener('click', (e) => {
            showLightBox();
            setActiveImage(image);
        })
    })
    lightboxContainer.addEventListener('click', () => {
        hideLightBox()
    })
    close.addEventListener('click', () => {
        hideLightBox()
    })
    lightboxBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            transitionSlideHandler(e.currentTarget.id);
        })
    })

    lightboxImage.addEventListener('click', (e) => {
        e.stopPropagation();

    })
</script>
<?php 
include 'footer.php';
?>