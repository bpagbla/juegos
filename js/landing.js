let listBg = document.querySelectorAll('.bg');
let banner = document.querySelector('.banner');
let tabs = document.querySelectorAll('.tab');
let contenido = document.querySelector('.contenido');
let heightDefault = contenido.offsetHeight;
let topBefore = 0;

window.addEventListener('wheel', function (event) {
    event.preventDefault();
    const scrollSpeed = 0.5;
    const scrollValue = window.scrollY + (event.deltaY / 3) * scrollSpeed;
    this.window.scrollTo(0, scrollValue);


    let top = scrollValue;


    listBg.forEach((bg, index) => {
        if (index != 0) {
            bg.animate({
                transform: `translateY(${(-top * index)}px)`
            },{
                duration: 1000, fill: "forwards"
            });
        }
        if (index == listBg.length - 1) {
            tabs.forEach(tab => {
                tab.animate({
                    transform: `translateY(${(-top * index)}px)`
                },{
                    duration: 500, fill: "forwards"
                });
                
            })
        }
        if (topBefore < top) {
            setHeight = heightDefault - this.window.scrollY * index;
            contenido.animate({
                height: `${setHeight + 100}px`
            }, { duration: 50, fill: "forwards" });
            topBefore = this.window.scrollY;
        }
    
    tabs.forEach((tab, index) => {
if(tab.offsetTop - top <= this.window.innerHeight*(index+1)){
    let content = tab.getElementsByClassName("content")[0];
    let transformContent = window.innerHeight*(index+1) - (tab.offsetTop - top);
    content.animate({
        transform: `tranlateY(${(-transformContent+(100*index))}px)`
    },{
        duration: 500, fill:"forwards"
    })
}
        })
    })
}, {
    passive: false
})

