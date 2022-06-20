require("./bootstrap");

import Alpine from "alpinejs";

import { Swiper } from "swiper";
import "swiper/css";
import "swiper/css/pagination";

window.Alpine = Alpine;

const swiper = new Swiper(".swiper", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            spaceBetween: 15,
            slidesPerView: 2,
        },
        770: {
            spaceBetween: 20,
            slidesPerView: 3,
        },
        1030: {
            spaceBetween: 25,
            slidesPerView: 4,
        },
    },
    autoplay: {
        delay: 25000,
        disableOnInteraction: false,
    },
});

const swiper_news = new Swiper(".swiper_news", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            spaceBetween: 15,
            slidesPerView: 2,
        },
        770: {
            spaceBetween: 20,
            slidesPerView: 3,
        },
        1030: {
            spaceBetween: 25,
            slidesPerView: 3,
        },
    },
    autoplay: {
        delay: 25000,
        disableOnInteraction: false,
    },
});

const related = new Swiper(".related", {
    slidesPerView: 5,
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    breakpoints: {
        0: {
            spaceBetween: 15,
            slidesPerView: 2,
        },
        770: {
            spaceBetween: 20,
            slidesPerView: 3,
        },
        1030: {
            spaceBetween: 25,
            slidesPerView: 4,
        },
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});

Alpine.start();