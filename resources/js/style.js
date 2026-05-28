document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector(".main-header");
    const logo = document.querySelector(".logo img");

    window.addEventListener("scroll", function() {
        if (window.scrollY > 40) {
            header.style.height = "80px";
            header.style.borderBottomWidth = "6px"; 
            header.style.borderBottomColor = "#D80C24"; 
            logo.style.height = "45px";
        } else {
            header.style.height = "110px";
            header.style.borderBottomWidth = "4px";
            header.style.borderBottomColor = "#000000";
            logo.style.height = "60px";
        }
    });

    const productSwiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 100,
        loop: true,
        speed: 800,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    const infoSwiper = new Swiper(".infoSwiper", {
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    const partenairesSwiper = new Swiper(".partenairesSwiper", {
        slidesPerView: 2,
        spaceBetween: 50,
        loop: true,
        speed: 4000, 
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: { slidesPerView: 3 },
            1024: { slidesPerView: 5 },
        },
    });

    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

});


document.querySelectorAll('.sub-link').forEach(link => {
    link.addEventListener('mouseenter', function() {
        const parentMega = this.closest('.mega-menu');
        
        parentMega.querySelectorAll('.sub-link').forEach(l => l.classList.remove('active'));
        parentMega.querySelectorAll('.model-grid').forEach(grid => {
            grid.classList.remove('active');
            grid.style.display = 'none';
        });

        this.classList.add('active');
        const targetId = this.getAttribute('data-target');
        const targetGrid = parentMega.querySelector(`#${targetId}`);
        
        if (targetGrid) {
            targetGrid.classList.add('active');
            targetGrid.style.display = 'grid';
        }
    });
});

// Gestion des filtres de la page catégorie
document.querySelectorAll('.custom-select').forEach(select => {
    select.addEventListener('click', function(e) {
        e.stopPropagation();
        const wrapper = this.parentElement;
        
        document.querySelectorAll('.custom-select-wrapper').forEach(w => {
            if (w !== wrapper) w.querySelector('.select-options').style.display = 'none';
        });

        const options = wrapper.querySelector('.select-options');
        options.style.display = options.style.display === 'block' ? 'none' : 'block';
    });
});

document.addEventListener('click', function() {
    document.querySelectorAll('.select-options').forEach(opt => opt.style.display = 'none');
});