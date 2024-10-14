let slideIndex = 0;
let slideInterval; // Store the interval for pausing

showSlides(); // Initialize the slideshow

function showSlides() {
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    // Remove active class from dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Show the current slide and add the active class to the corresponding dot
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";

    slideInterval = setTimeout(showSlides, 5000); // Change image every 5 seconds
}

// Manual slide control
function currentSlide(n) {
    clearTimeout(slideInterval); // Clear the interval when a manual action is taken
    slideIndex = n;
    showSlides(); // Restart the slideshow
}

function nextSlide() {
    clearTimeout(slideInterval); // Clear the interval
    slideIndex++;
    if (slideIndex > document.getElementsByClassName("mySlides").length) {
        slideIndex = 1;
    }
    showSlides();
}

function prevSlide() {
    clearTimeout(slideInterval); // Clear the interval
    slideIndex--;
    if (slideIndex < 1) {
        slideIndex = document.getElementsByClassName("mySlides").length;
    }
    showSlides();
}

// Pause the slideshow when hovering over the image
document.querySelector('.slideshow-container').addEventListener('mouseenter', function() {
    clearTimeout(slideInterval); // Clear the interval to stop the slideshow
});

document.querySelector('.slideshow-container').addEventListener('mouseleave', function() {
    showSlides(); // Restart the slideshow when hover ends
});
