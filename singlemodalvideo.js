
//  v2 so you can click on image and section title as well as button to fire the video modal
document.addEventListener("DOMContentLoaded", function() {

    const modals = document.querySelectorAll('.modal-video-popup');
    const openModalBtns = document.querySelectorAll('.open-modal-btn');
    const bgImgDivs = document.querySelectorAll('.bg_img_div');
    const sectionNames = document.querySelectorAll('.section_name');
    const closeXBtns = document.querySelectorAll('.close-button');

    openModalBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            modals[index].style.display = 'block';
        });
    });

    bgImgDivs.forEach((bgDiv, index) => {
        bgDiv.addEventListener('click', () => {
            modals[index].style.display = 'block';
        });
    });

    sectionNames.forEach((sectionName, index) => {
        sectionName.addEventListener('click', () => {
            modals[index].style.display = 'block';
        });
    });

    closeXBtns.forEach((closeBtn, index) => {
        closeBtn.addEventListener('click', () => {
            modals[index].style.display = 'none';
        });
    });

    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', (e) => {
        modals.forEach((modal) => {
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        });
    });


    function hideIOSBarsInLandscape() {
        if (window.matchMedia("(orientation: landscape)").matches && screen.width < 800) {
            window.scrollTo(0, 1);
        }
    }

    window.addEventListener("load", hideIOSBarsInLandscape);

    window.addEventListener("orientationchange", hideIOSBarsInLandscape);

});

