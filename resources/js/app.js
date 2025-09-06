import './bootstrap';
import.meta.glob("/resources/images/**/*.{svg,webp,png,jpg,jpeg,ico}", {
    eager: true,
});

import $ from 'jquery';
window.$ = window.jQuery = $;

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
