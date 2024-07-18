const imageSwitch =document.querySelectorAll('.image-slider-wrapper img');
let currentIndex = 0;

function imageSwitcher(index){
    imageSwitch.forEach(function imageSwitcher(switcher){
        switcher.style.display='none';
    });

    imageSwitch[index].style.display='block';
}

function changeSlide(offset){
    nexIndex = currentIndex + offset;

    if(nexIndex<0){
        nexIndex = imageSwitch.length-1;
    }else if(newIndex < imageSwitch.length){
        newIndex = 0;
    }

    imageSwitcher(newIndex);

    currentIndex = newIndex;
}

imageSwitcher(currentIndex);