//ON SCROLL ANIMATE
var scroll = window.requestAnimationFrame ||
function(callback){ window.setTimeout(callback, 1000/60)};
var elementsToShow = document.querySelectorAll('.show-on-scroll'); 
function loop() {
    Array.prototype.forEach.call(elementsToShow, function(element){
        if (isElementInViewport(element)) {
            element.classList.add('is-visible');
        }
    });
    scroll(loop);
}
loop();

function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }
    var rect = el.getBoundingClientRect();
    return (
        (rect.top <= 0
        && rect.bottom >= 0)
        ||
        (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.top <= (window.innerHeight || document.documentElement.clientHeight))
        ||
        (rect.top >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
    );
}




//SCROLL ANIMATE
var scroll2 = window.requestAnimationFrame ||
function(callback2){ window.setTimeout(callback2, 1000/60)};
var elementsToShow2 = document.querySelectorAll('.show-on-scroll2'); 
function loop2() {
    Array.prototype.forEach.call(elementsToShow2, function(element){
        if (isElementInViewport(element)) {
            element.classList.add('is-visible2');
        } 
    });

    scroll2(loop2);
}
loop2();

function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }
    var rect2 = el.getBoundingClientRect();
    return (
        (rect2.top <= 0
        && rect2.bottom >= 0)
        ||
        (rect2.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
        rect2.top <= (window.innerHeight || document.documentElement.clientHeight))
        ||
        (rect2.top >= 0 &&
        rect2.bottom <= (window.innerHeight || document.documentElement.clientHeight))
    );
}



//SCROLL ANIMATE
var scroll3 = window.requestAnimationFrame ||
function(callback3){ window.setTimeout(callback3, 1000/60)};
var elementsToShow3 = document.querySelectorAll('.show-on-scroll3'); 
function loop3() {
    Array.prototype.forEach.call(elementsToShow3, function(element){
        if (isElementInViewport(element)) {
            element.classList.add('is-visible3');
        }
    });
    scroll3(loop3);
}
loop3();


function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }
    var rect3 = el.getBoundingClientRect();
    return (
        (rect3.top <= 0
        && rect3.bottom >= 0)
        ||
        (rect3.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
        rect3.top <= (window.innerHeight || document.documentElement.clientHeight))
        ||
        (rect3.top >= 0 &&
        rect3.bottom <= (window.innerHeight || document.documentElement.clientHeight))
    );
}

