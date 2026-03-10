
    document.addEventListener('DOMContentLoaded', function() {

        function updateLayoutBackground(dropdown) {
            const bgImage = dropdown.getAttribute('data-background'); 

            if (bgImage) {
                const bgImageSRC = new Image();
                bgImageSRC.src = bgImage;

                const wrapperBg = document.querySelector('.body--wrapper__bg');
                const currentBg = window.getComputedStyle(wrapperBg).backgroundImage;

                bgImageSRC.onload = function() {
                    wrapperBg.style.backgroundImage = `url('${bgImageSRC.src}')`;
                    wrapperBg.classList.add('updated_image');
                    
                    showHideVid();
                };
                wrapperBg.style.backgroundImage = currentBg;
            } else {
                console.error('No background image found for this dropdown.');
            }
        }

        function showHideVid() {
  
            const imageOn = document.querySelector('section.body--wrapper__bg.pathways_bg_image.updated_image');

            if (imageOn) {
                const videoContainer = document.querySelector('#background-video-container.background-video');
                if (videoContainer) {
                    videoContainer.style.display = 'none';
                }
            } else {
                const videoContainer = document.querySelector('#background-video-container.background-video');
                if (videoContainer) {
                    videoContainer.style.display = 'block';
                }
            }

        }
        showHideVid();
 
        function handleClick() {
            console.log('handleClick Button clicked');
            const button = event.currentTarget;
            const dropdown = button.closest('.dropdown');

            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('active');
                }
            });
            dropdown.classList.toggle('active');

            const isAnyDropdownOpen = Array.from(dropdowns).some(d => d.classList.contains('active'));

            const splashWrapper = document.querySelector('.atf--splash__wrapper');
            if (splashWrapper) {
                splashWrapper.style.display = isAnyDropdownOpen ? 'none' : 'block';
            }

            if (dropdown.classList.contains('active')) {
                updateLayoutBackground(dropdown);
            }
        }

        window.handleClick = handleClick;
        handleClick();

        const dropdownButtons = document.querySelectorAll('.dropbtn');
        dropdownButtons.forEach(button => {

            //   const viewportWidth = window.innerWidth || document.documentElement.clientWidth
              
            //   if (viewportWidth > 768) {
            //     button.addEventListener('click', handleClick);
            //   } else {
            //     button.addEventListener('touchstart', handleClick);
            //   }  
              
               button.addEventListener('click', handleClick);
        });

        function applyMobileLinkBehavior() {
    const viewportWidth = window.innerWidth || document.documentElement.clientWidth;

    if (viewportWidth < 768) {
        const specificButtons = document.querySelectorAll('.pathways_button_one');

        specificButtons.forEach(function(button) {
            const link = button.getAttribute('href');

            if (link) {
                button.addEventListener('click', function(e) {
          
                    console.log('Navigating to:', link);
                   
                });

                button.addEventListener('touchstart', function(e) {
                    console.log('Touching link to:', link);
                  
                });
            }
        });
    }
}





        applyMobileLinkBehavior();
        window.addEventListener('resize', applyMobileLinkBehavior);



        // function togglePurpleSectionContent_null() {
        //     const purpleSection = document.querySelector('#dropdown_content_2.dropdown-content.section_colour_purple');

        //     purpleSection.addEventListener('click', function() {
        //         const purpleDropdown = document.querySelector('#dropdown-2.dropdown');

        //         const viewportWidth = window.innerWidth || document.documentElement.clientWidth;

        //         if (viewportWidth < 768) {
        //             console.log("mobile purple toggle");
        //             if (purpleDropdown.classList.contains('active')) {
        //                 console.log('Closing the purple section');
        //                 purpleDropdown.classList.add('active');
        //             } else {
        //                 purpleDropdown.classList.remove('active');
        //                 console.log('Purple section is not active.');
        //             }
        //         }
        //     });
        // }
        // togglePurpleSectionContent_null();

//         function togglePurpleSectionContent_null2() {
//     const purpleSection = document.querySelector('#dropdown_content_2.dropdown-content.section_colour_purple');

//     if (!purpleSection) return;

//     purpleSection.addEventListener('click', function () {
//         const purpleDropdown = document.querySelector('#dropdown-2.dropdown');

//         if (!purpleDropdown) return;

//         const viewportWidth = window.innerWidth || document.documentElement.clientWidth;

//         if (viewportWidth < 768) {
//             console.log("mobile purple toggle");

//             // This correctly toggles the 'active' class
//             if (purpleDropdown.classList.contains('active')) {
//                 purpleDropdown.classList.remove('active');
//                 console.log('Closing the purple section');
//             } else {
//                 purpleDropdown.classList.add('active');
//                 console.log('Opening the purple section');
//             }
//         }
//     });
// }

// togglePurpleSectionContent_null2();


        


        // function togglePurpleSection_null3() {
        //     const dropdown_others = document.querySelectorAll('#dropdown-0.dropdown, #dropdown-1.dropdown');
        //     const viewportWidthSectionThree = window.innerWidth || document.documentElement.clientWidth;

        //     if (viewportWidthSectionThree < 768) {
        //         const thirdActive = document.querySelectorAll('#dropdown-2.dropdown.active');

        //         if (thirdActive.length > 0) {
        //             console.log('Third dropdown is active, hiding others.');
        //             dropdown_others.forEach(function(dropdown) {
        //                 dropdown.style.display = "none";
        //             });
        //         } else {
        //             console.log('Third dropdown is not active, others remain visible.');
        //         }

        //         const thirdDropdown = document.querySelectorAll('#dropdown-2.dropdown');
        //         thirdDropdown.forEach(function(dropdown) {
        //             dropdown.addEventListener('click', function() {
        //                 dropdown.classList.toggle('active');
        //             });

        //             dropdown.addEventListener('touchstart', function() {
        //                 dropdown.classList.toggle('active');
        //             });
        //         });

        //     }
        // }
        // togglePurpleSection_null3();

        const dropdown2 = document.getElementById('dropdown-2');
        const initialBackground = dropdown2.getAttribute('data-background');

        function changeBackgroundImage(event) {
            const button = event.currentTarget;
            const dropdown = button.closest('.dropdown');

            if (dropdown.id === 'dropdown-2') {
                const imageUrl = button.getAttribute('data-bg-image');
                console.log('Changing background to:', imageUrl);

                if (dropdown) {
                    dropdown.setAttribute('data-background', imageUrl);
                    dropdown.querySelector('.dropdown-content-wrapper').style.backgroundImage = `url(${imageUrl})`;

                    const wrapperBg = document.querySelector('.body--wrapper__bg');
                    wrapperBg.style.backgroundImage = `url(${imageUrl})`;
                }
            }
        }

        function resetBackgroundImage(event) {
            const button = event.currentTarget;
            const dropdown = button.closest('.dropdown');

            if (dropdown.id === 'dropdown-2') {
                console.log('Resetting background to initial:', initialBackground);

                if (dropdown) {
                    dropdown.querySelector('.dropdown-content-wrapper').style.backgroundImage = `url(${initialBackground})`;

                    const wrapperBg = document.querySelector('.body--wrapper__bg');
                    wrapperBg.style.backgroundImage = `url(${initialBackground})`;
                }
            }
        }

        const dropdown2Buttons = document.querySelectorAll('#dropdown-2 .pathways_button');
        dropdown2Buttons.forEach(button => {
            console.log('Adding event listeners to:', button);
            button.addEventListener('mouseover', changeBackgroundImage);
            button.addEventListener('mouseout', resetBackgroundImage);
            // button.addEventListener('touchstart', changeBackgroundImage);    
        });
});
