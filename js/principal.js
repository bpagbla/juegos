/* global bootstrap: false */
(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()

const filterModal = new bootstrap.Modal('#filter-modal', {
    keyboard: false
})
document.getElementById('filter-button').addEventListener('click', function () {
    filterModal.show();
})

window.onload = function () {
    slideOne();
    slideTwo();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.textContent = sliderOne.value;
    fillColor();
}
function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.textContent = sliderTwo.value;
    fillColor();
}
function fillColor() {
    percent1 = ((sliderOne.value-1952) / (sliderMaxValue-1952)) * 100;
    percent2 = ((sliderTwo.value-1952) / (sliderMaxValue-1952)) * 100;
    sliderTrack.style.background = `linear-gradient(to right, #FFFFFF ${percent1}% , #A020F0 ${percent1}% , #A020F0 ${percent2}%, #FFFFFF ${percent2}%)`;
}

sliderOne.addEventListener('input',slideOne)
sliderTwo.addEventListener('input',slideTwo)
