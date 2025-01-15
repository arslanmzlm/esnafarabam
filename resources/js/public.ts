import Splide from '@splidejs/splide';
import '@splidejs/splide/css';

// Image Fix For Public
import.meta.glob(['../images/**']);

window.onload = () => {
    if (
        document.getElementById('item-photo-carousel') &&
        document.getElementById('item-thumbnail-carousel')
    ) {
        var main = new Splide('#item-photo-carousel', {
            type: 'slide',
            rewind: true,
            pagination: false,
            arrows: false,
            cover: false,
        });

        var thumbnails = new Splide('#item-thumbnail-carousel', {
            perPage: 5,
            perMove: 5,
            isNavigation: true,
            gap: 5,
            focus: 'center',
            pagination: false,
            cover: true,
            dragMinThreshold: {
                mouse: 4,
                touch: 10,
            },
        });

        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    }

    if (document.getElementById('home-page-slider')) {
        new Splide('#home-page-slider', {
            type: 'loop',
            autoHeight: true,
            autoplay: true,
            interval: 5000,
            pauseOnHover: true,
        }).mount();
    }

    const accordions = document.querySelectorAll('.accordion');
    if (accordions.length) {
        accordions.forEach((accordion) => {
            const button = accordion.querySelector('.accordion-button');
            if (button) {
                button.addEventListener('click', () => {
                    accordion.classList.toggle('active');
                });
            }
        });
    }

    const mobileNav = document.getElementById('mobileNav');
    const mobileNavButtons = document.querySelectorAll('.mobile-nav-btn');
    if (mobileNav && mobileNavButtons.length) {
        mobileNavButtons.forEach((button) => {
            button.addEventListener('click', () => {
                button.classList.toggle('text-primary');
                mobileNav.classList.toggle('active');
                document.body.classList.toggle('overflow-hidden');
            });
        });
    }

    const headerSearch = document.getElementById('headerSearch');
    const headerSearchButtons = document.querySelectorAll('.header-search-btn');
    if (headerSearch && headerSearchButtons.length) {
        headerSearchButtons.forEach((button) => {
            button.addEventListener('click', () => {
                button.classList.toggle('text-primary');
                headerSearch.classList.toggle('active');
            });
        });
    }
};
