@extends('layout')

@section('content')
<br><br><br><br>
<center>
<div class="minio-header-complex">
    <button class="home-toggle"><a href="/"><i class="fa fa-home"></i> Home</a></button>
    <button class="about-toggle"><a href="#"><i class="fas fa-info-circle"></i> About</a></button>
    <button class="service-toggle"><a href="/import-product"><i class="fas fa-file-import"></i> Inventory</a></button>
    <button class="contact-toggle"><a href="/dashboard"><i class="fas fa-file-export"></i> Export/Sale</a></button>
    @auth('web')
    <form action="/logout" method="POST" class="logout-invalidate">
        @csrf
        <button type="submit" class="logout-toggle"><i class="fa fa-sign-out"></i> Logout</button>
    </form>
    @else
    <button class="login-toggle"><a href="/signin"><i class="fa fa-sign-in"></i> Login</a></button>
    <br><br>
    @endauth
</div>
<div class="mobile-viewable-only">
    <br>
    <p>Member Computer Technology</p>
    <button class="menu-navigator" onclick="openSideMenu()">&#9776;</button>
</div>


<div class="image-slider-wrapper">
    <img src="{{asset('assets/images/image-sliedera.png')}}" alt="Sliding Image">
    <img src="{{asset('assets/images/image-sliderb.png')}}" alt="Sliding Image">
    <img src="{{asset('assets/images/image-sliderc.jpg')}}" alt="Sliding Image">
    <img src="{{asset('assets/images/image-sliderd.jpg')}}" alt="Sliding Image">
    <img src="{{asset('assets/images/image-slidere.jpg')}}" alt="Sliding Image">
</div>

<div class="button-controll-clicker">
    <button class="prev" onclick="changeSlide(-1)">&#8592;</button>
    <button class="next" onclick="changeSlide(1)">&#8594;</button>
</div>

<div class="mobile-view-phone-menus">
    <a href="#" id="close-menu" onclick="closeSideMenu()">&times;</a>
    <a href="/">Home</a><br><br>
    <a href="#">About Us</a><br><br>
    <a href="#">Import Product</a><br><br>
    <a href="#">Export Product</a><br><br>
    <a href="/signin">Login</a><br><br>
</div>


<script>
    const imageslider=document.querySelectorAll('.image-slider-wrapper img');
const intervalTime = 6000;
let initialImage=0;

function showNextImage(){
    imageslider[initialImage].style.display='none';
    
    initialImage++;

    if(initialImage>=imageslider.length){
        initialImage=0;
    }

    imageslider[initialImage].style.display='block';
    imageslider[initialImage].style.animation='slideFromRightSlow 1s forwards';
}

setInterval(showNextImage,intervalTime);
</script>


<script>
    const imageSwitch = document.querySelectorAll('.image-slider-wrapper img');
    let currentIndex = 0;

function imageSwitcher(index){
    imageSwitch.forEach(function imageSwitcher(switcher){
        switcher.style.display='none';
    });

    imageSwitch[index].style.display='block';
}

function changeSlide(offset){

    newIndex = currentIndex + offset;

    if(newIndex < 0){
        newIndex = imageSwitch.length-1;
    }else if(newIndex >= imageSwitch.length){
        newIndex = 0;
    }

    imageSwitcher(newIndex);

    currentIndex = newIndex;
}

imageSwitcher(currentIndex);

</script>
</center>
@endsection