document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.kings-carousel');

    carousels.forEach(carousel => {
        const carouselInner = carousel.querySelector('.ke-carousel-inner');
        const items = Array.from(carouselInner.querySelectorAll('.ke-carousel-item'));
        const totalCarousels = items.length;
        const prevControl = carousel.querySelector('.ke-carousel-control-prev');
        const nextControl = carousel.querySelector('.ke-carousel-control-next');
        const headings = carousel.querySelectorAll('.heading');

        const headingContents = Array.from(headings).map(heading => heading.textContent);

        console.log(headingContents, 'number of items in array: ', totalCarousels);

        const marginRight = 30;
        const marginLeft = 30;

        const itemWidth = items[0].offsetWidth + marginRight;
        const mobileItemWidth = items[0].offsetWidth + marginLeft;

        function cloneItems() {
            const clonedItemsContainer = document.createDocumentFragment();

            for (let i = 0; i < 6; i++) {
                items.forEach(item => clonedItemsContainer.appendChild(item.cloneNode(true)));
            }
            carouselInner.appendChild(clonedItemsContainer);
            carouselInner.scrollLeft = itemWidth;
        }

        function handleViewportChange() {
            if (window.matchMedia("(min-width: 768.2px)").matches) {
                if (totalCarousels >= 4) {
                    cloneItems();
                    carouselInner.classList.add('dtArrayPlus');
                    carouselInner.classList.remove('dtArrayLess');
                    console.log('Class "dtArrayPlus" added to', carouselInner);
                } else {
                    carouselInner.classList.add('dtArrayLess');
                    carouselInner.classList.remove('dtArrayPlus');
                    console.log('Class "dtArrayLess" added to', carouselInner);
                }

                items.forEach(item => item.classList.remove('marginLeft80'));
            } else if (window.matchMedia("(max-width: 768px)").matches) {
                if (totalCarousels > 1) {
                    cloneItems();
                    carouselInner.classList.add('dtArrayLess');
                    carouselInner.classList.remove('dtArrayPlus');
                    console.log('Class "dtArrayLess" added to', carouselInner);
                }

                items.forEach(item => {
                    item.classList.toggle('marginLeft80', totalCarousels < 2);
                });
            }

            if (window.matchMedia("(min-width: 768.2px)").matches) {
                if (totalCarousels <= 3) {
                    if (prevControl) prevControl.style.display = 'none';
                    if (nextControl) nextControl.style.display = 'none';
                } else {
                    if (prevControl) prevControl.style.display = 'block';
                    if (nextControl) nextControl.style.display = 'block';
                }
            }

            if (window.matchMedia("(max-width: 768px)").matches) {
                if (totalCarousels <= 1) {
                    if (prevControl) prevControl.style.display = 'none';
                    if (nextControl) nextControl.style.display = 'none';
                } else {
                    if (prevControl) prevControl.style.display = 'none';
                    if (nextControl) nextControl.style.display = 'none';
                }
            }
        }

        window.addEventListener('resize', handleViewportChange);
        window.addEventListener('load', handleViewportChange);

        handleViewportChange();

        function updateCarousel(direction) {
            const maxScrollLeft = carouselInner.scrollWidth - carouselInner.clientWidth;
            let currentScrollLeft = carouselInner.scrollLeft;
            let scrollAmount = direction === 'next' ? itemWidth : -itemWidth;

            if (window.matchMedia("(max-width: 768px)").matches) {
                scrollAmount = direction === 'next' ? mobileItemWidth : -mobileItemWidth;
            }

            if (direction === 'next') {
                if (currentScrollLeft + scrollAmount >= maxScrollLeft) {
                    carouselInner.style.transition = 'none';
                    carouselInner.scrollLeft = maxScrollLeft;
                    setTimeout(() => carouselInner.style.transition = 'transform 0.5s ease', 20);
                } else {
                    carouselInner.style.transition = 'transform 0.5s ease';
                    carouselInner.scrollLeft += scrollAmount;
                }
            } else if (direction === 'prev') {
                if (currentScrollLeft + scrollAmount <= 0) {
                    carouselInner.style.transition = 'none';
                    carouselInner.scrollLeft = 0;
                    setTimeout(() => carouselInner.style.transition = 'transform 0.5s ease', 20);
                } else {
                    carouselInner.style.transition = 'transform 0.5s ease';
                    carouselInner.scrollLeft += scrollAmount;
                }
            }
        }


        if (nextControl) nextControl.addEventListener('click', () => updateCarousel('next'));
        if (prevControl) prevControl.addEventListener('click', () => updateCarousel('prev'));
    });

    let startX, startY, endX, endY;

    document.querySelectorAll('.ke-carousel').forEach(carousel => {
        carousel.addEventListener('touchstart', event => {
            const touch = event.touches[0];
            startX = touch.clientX;
            startY = touch.clientY;
        });

        carousel.addEventListener('touchend', event => {
            const touch = event.changedTouches[0];
            endX = touch.clientX;
            endY = touch.clientY;

            const deltaX = endX - startX;
            const deltaY = endY - startY;
            const swipeThreshold = 50;

            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > swipeThreshold) {
                const direction = deltaX < 0 ? 'next' : 'prev';
                const controlButton = carousel.querySelector(`.ke-carousel-control-${direction}`);
                if (controlButton) controlButton.click();
            }
        });
    });

    // Hide lists on page load
    document.querySelectorAll('.dash-content.list_view').forEach(element => element.style.display = 'none');
    document.querySelectorAll('.dash-content.list_view.product_1').forEach(element => element.style.display = 'none');
    document.querySelectorAll('.dash-content.list_view.product_2').forEach(element => element.style.display = 'none');
    document.querySelectorAll('.dash-content.list_view.product_3').forEach(element => element.style.display = 'none');
    document.querySelectorAll('.dash-content.list_view.product_4').forEach(element => element.style.display = 'none');

    function isMobile() {
        const isAndroid = /Android/i.test(navigator.userAgent);
        const isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);
        const isMobileViewport = window.innerWidth <= 768;
        return (isAndroid || isIOS) && isMobileViewport;
    }

    function isIOSMobile() {
        const isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);
        const isMobileViewport = window.innerWidth <= 768;
        return isIOS && isMobileViewport;
    }

    if (isIOSMobile()) {
        console.log("This is a mobile viewport on an iOS device.");
    } else if (isMobile()) {
        console.log("This is a mobile viewport on an Android device.");
    }

    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);
    if (params.get('cat_id')) {
        document.querySelector('.edit-search-link').setAttribute('href', `/search/${params.get('cat_id')}`);
    }

    function hideView(view) {
        console.log('hideView function called with view:', view);
        const thumbView = document.querySelectorAll('.thumb_view');
        const listView = document.querySelectorAll('.list_view');
        const filterList = document.querySelectorAll('.filter_view_icon.filter_list');
        const filterThumb = document.querySelectorAll('.filter_view_icon.filter_thumb');

        if (view === 'list') {
            thumbView.forEach(element => element.style.display = 'none');
            listView.forEach(element => element.style.display = 'block');
            filterList.forEach(element => element.classList.add('active'));
            filterThumb.forEach(element => element.classList.remove('active'));
        } else {
            thumbView.forEach(element => element.style.display = 'block');
            listView.forEach(element => element.style.display = 'none');
            filterList.forEach(element => element.classList.remove('active'));
            filterThumb.forEach(element => element.classList.add('active'));
        }
    }

    function filterResult(filterType) {
        const pageUrl = new URL(window.location.href);
        pageUrl.searchParams.set('filter', filterType);
        const parameter = pageUrl.search.slice(1);

        fetch("{{ route('do-kings-search-new') }}", {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: parameter
        }).then(response => response.text())
        .then(data => {
            document.querySelector('.load-mask').style.display = 'none';
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.sidebar').style.display = 'none';
            document.body.innerHTML = data;
            window.history.replaceState(null, null, pageUrl);
            filterResultData(filterType);
        }).catch(() => {
            document.querySelector('.load-mask').style.display = 'none';
            document.querySelector('.loader').style.display = 'none';
        });
    }

    function filterResultData(filterType) {
        let filterBy;
        const searchResultFilterIcons = document.querySelectorAll('.search_result_filter_icon');
        const thumbItems = document.querySelectorAll('.thumb_view .asset-item');
        const listItems = document.querySelectorAll('.list_view .asset-item');
        const thumbRows = document.querySelectorAll('.thumb_view .type-row');
        const listRows = document.querySelectorAll('.list_view .type-row');

        searchResultFilterIcons.forEach(icon => {
            icon.classList.remove('active');
        });

        if (filterType === 'photos') {
            filterBy = 4;
            document.querySelector('.search_result_filter_icon.photos').classList.add('active');
        } else if (filterType === 'video') {
            filterBy = 9;
            document.querySelector('.search_result_filter_icon.video').classList.add('active');
        } else if (filterType === 'vrtour') {
            filterBy = 7;
            document.querySelector('.search_result_filter_icon.vrtour').classList.add('active');
        } else if (filterType === 'pdf') {
            filterBy = 10;
            document.querySelector('.search_result_filter_icon.pdf').classList.add('active');
        } else if (filterType === 'factsheet') {
            filterBy = 'factsheet';
        } else {
            filterBy = '';
            document.querySelector('.search_result_filter_icon.all').classList.add('active');
        }

        thumbItems.forEach(item => {
            if (item.dataset.itemAssetId != filterBy) {
                item.remove();
            }
        });

        listItems.forEach(item => {
            if (item.dataset.itemAssetId != filterBy) {
                item.remove();
            }
        });

        thumbRows.forEach(row => {
            if (row.querySelector('.grid .asset-item').children.length === 0) {
                row.remove();
            }
        });

        listRows.forEach(row => {
            if (row.querySelector('.asset-item').children.length === 0) {
                row.remove();
            }
        });
    }
});