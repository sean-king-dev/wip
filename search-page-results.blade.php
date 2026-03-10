@extends('layouts.app')
@section('style')
<style>
    :root {
        --image-asset-width-lg: 310px;
        --image-asset-height-lg: 200px;
        --image-asset-width-sm: 221px;
        --image-asset-height-sm: 145px;
        --minus-handle-height-lg: -200px;
        --carousel-handle-height-lg: 200px;
        --carousel-handle-height-sm: 155px;
        --minus-handle-height-sm-left: -260px;
        --minus-handle-height-sm-right: -260px;
        --carousel-handle-width-lg: 100px;
        --carousel-handle-width-sm: 50px;
    }

    /* top search section */
    .dashboard {
        padding: 1%;
        position: relative;
    }

    h1.title {
        margin: 0;
        padding: 0 0 2% 0;
    }

    .result-top h1.title {
        font-size: 22px;
        font-weight: bold;
        font-family: 'BwDarius';
        padding-left: 2%;
        background: #fff;
    }

    .dashboard .dash-top {
        background: unset !important;
    }

    .dash-top,
    a.edit-search-link,
    .search_result_filter {
        color: #fff !important;
    }

    .search_result_filter {
        display: flex;
    }

    .search_result_filter_section {
        display: flex;
        width: 90%;
    }

    .search_result_filter_icon {
        display: block;
    }

    .filter_label {
        font-size: 11px;
        text-align: center;
        padding-top: 20%;
        margin-top: 40px;
        color: #fff;
    }

    .filter_view_icon_container {
        display: flex;
        justify-content: flex-end;
        width: 20%;
    }

    .filter_view_icon {
        float: left;
        margin: 0 5%;
        color: white;
        border-radius: 50%;
        height: 40px;
        width: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .dash-content {
        overflow-x: hidden;
    }

    .loader {
        display: none;
    }

    /* carousel section */
    .heading {
        font-family: 'BwDarius';
        font-weight: bolder;
        font-size: 18px;
        padding: 3% 0 2% 1.5%;
        color: #fff;
    }

    .carousel-inner {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        width: 115% !important;
    }

    .carousel-item {
        display: block !important;
    }

    .carousel-control-prev,
    .carousel-control-next {
        z-index: 10;
        background: rgba(255, 255, 255, 0) !important;
        width: 10% !important;
    }

    .carousel-control-prev {
        position: relative;
        left: -5% !important;
    }

    .carousel-control-next {
        position: relative;
        right: -5% !important;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        z-index: 10;
        background: rgba(255, 255, 255, 0.5) !important;
    }

    .fa.fa-chevron-left::before,
    .fa.fa-chevron-right::before {
        color: #ffffff70;
    }

    div.asset_label.text {
        background: #fff;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* bootstrap free carousel styles */
    @media screen and (min-width:768.5px) {
        .ke-carousel-inner {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            overflow: hidden !important;
            width: 115% !important;
            height: 230px;
            scroll-behavior: smooth;
            transition: transform 0.5s ease;
            /* padding-left: 25%; */
            position: relative;
            left: 0;
        }

        .ke-carousel.ke-slide.dtArrayLess .ke-carousel-inner {
            padding-left: 0%;
        }

        .kings-carousel .grid .asset-item .image {
            height: 204px !important;
            width: 260px !important;
        }

        .search_result_main .dash-content.thumb_view .heading {
            margin-left: -1% !important;
        }

        /* div.grid.key-contacts.ke-carousel-inner.ke-row.dtArrayPlus {
        border: 2px solid lime;
    } */
    }

    .ke-carousel-item {
        height: 220px;
        display: block !important;
    }

    .grid .asset-item {
        height: 200px;
        width: 260px !important;
        margin-right: 30px !important;
    }

    .grid .asset-item .image {
        border-radius: 8px !important;
    }

    .kings-carousel .image.image_position {
        height: 200px;
    }

    .grid .asset-item .text {
        height: 60px;
        padding: 12px;
        font-size: 14px !important;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        top: -60px;
        display: flex;
        justify-content: left;
        align-items: center;
        color: #000;
    }

    .asset_label.text {
        font-size: 14px;
    }

    .ke-carousel-control-prev,
    .ke-carousel-control-next {
        display: block;
        position: relative;
        width: 7%;
    }

    .kings-carousel {
        height: 300px;
    }

    .ke-carousel-control-prev {
        left: -4.5%;
        height: 210px;
        top: -235px !important;
    }

    .ke-carousel-control-next {
        right: -98%;
        height: 210px;
        top: -442px !important;
    }

    i.fa.fa-chevron-left,
    i.fa.fa-chevron-right {
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0);
    }

    i.fa.fa-chevron-left {
        padding-left: 100%;
        position: absolute;
        left: -7vh;
        top: 45%;
        z-index: 10;
    }

    i.fa.fa-chevron-right {
        padding-left: 87%;
        position: absolute;
        right: 2.5vh;
        top: 45%;
        z-index: 10;
    }

    .ke-carousel-control-prev:hover,
    .ke-carousel-control-next:hover {
        background: rgba(255, 255, 255, 0.4);
    }

    a:hover {
        text-decoration: none !important;
    }

    /* mobile styles */
    @media screen and (max-width:768px) {

        .page-content .dashboard {
            margin-top: 15vh;
        }

        .search_result_filter_section {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .filter_view_icon_container {
            float: right !important;
            clear: right !important;
            display: block;
            margin-top: 10% !important;
        }

        .dash-content.thumb_view .heading {
            margin: 10% 0 0 2% !important;
        }

        .kings-carousel {
            height: 200px;
        }

        .ke-carousel-inner {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            overflow: hidden !important;
            width: 115% !important;
            height: 230px;
            scroll-behavior: smooth;
            transition: transform 0.5s ease !important;
            padding-left: 19%;
        }

        div.grid.key-contacts.ke-carousel-inner.ke-row.dtArrayLess {
            /* border: 2px solid lime; */
            padding-left: 3% !important;
        }

        @supports (-webkit-backdrop-filter: none) {
            div.grid.key-contacts.ke-carousel-inner.ke-row.dtArrayLess {
                /* border: 2px solid dodgerblue; */
                padding-left: 5% !important;
            }

        }

        .grid .asset-item {
            height: var(--image-asset-height-sm);
            width: var(--image-asset-width-sm);
        }

        .grid .asset-item .image {
            border-radius: 8px !important;
            height: var(--image-asset-height-sm);
        }

        .kings-carousel .image.image_position {
            width: var(--image-asset-width-sm) !important;
            height: var(--image-asset-height-sm) !important;
        }

        .grid .asset-item .text {
            top: -37px;
            height: 40px;
        }

        div.asset_label.text {
            position: absolute;
            bottom: 0;
        }

        .grid .asset-item .asset-type-icon {
            margin-left: -20px;
        }

        .grid .asset-item .asset_type_name {
            padding-top: 5px;
        }

        .carousel-control-prev {
            left: 0 !important;
        }

        .carousel-control-next {
            right: 0 !important;
        }

        .ke-carousel-control-next {
            right: -90%;
            height: var(--carousel-handle-height-sm);
            top: calc(var(--minus-handle-height-sm-left) + var(--minus-handle-height-sm-right)) !important;
            z-index: 10;
            display: none;
        }

        .ke-carousel-control-prev {
            left: 0%;
            top: var(--minus-handle-height-sm-left);
            height: var(--carousel-handle-height-sm) !important;
            z-index: 10;
            display: none;
            width: 10%;
        }

        .ke-carousel-control-next {
            width: 10%;
            height: var(--carousel-handle-height-sm) !important;
            transform: translateY(85%);
            display: none;
            /* border: 1px solid lime; */
        }

        .ke-carousel-control-prev:hover,
        .ke-carousel-control-next:hover {
            background: rgba(255, 255, 255, 0.4) !important;
        }

        i.fa.fa-chevron-left {
            left: -3vh;
        }

        i.fa.fa-chevron-right {
            right: 1vh;
        }

        .marginLeft80 {
            margin-left: -16%;
        }

        /* list/ grid */

        @media screen and (max-width:767px) {
            .type-row [role="listbox"] .asset-item.list_title .list_view_data {
                width: 92%;
                font-size: 1rem;
                margin-left: 4%;
                height: 100%;
            }


            .type-row [role="listbox"] .asset-item.list_title .list_view_data .asset-type-icon {
                margin-left: 0%;
            }

            .inline_title {
                width: 100% !important;
                /* margin-bottom: 1%; */
            }

        }

    }

    /* background colours */
    .search_result_main.product_1,
    .search_section.product_1,
    .dash-content.list_view.product_1 {
        background-color: #65306d !important;
        color: white;
    }

    .search_result_main.product_2,
    .search_section.product_2,
    .dash-content.list_view.product_2 {
        background-color: #004d73 !important;
        color: white;
    }

    .search_result_main.product_3,
    .search_section.product_3,
    .dash-content.list_view.product_3 {
        background-color: #2b9885 !important;
        color: white;
    }

    .search_result_main.product_4,
    .search_section.product_4,
    .dash-content.list_view.product_4 {
        background-color: #59c6e7 !important;
        color: white;
    }

    .search_result_filter_icon:hover {
        cursor: pointer !important;
    }

    #loading-mask {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        display: none;
        /* hidden by default */
        align-items: center;
        justify-content: center;
        z-index: 999;
        /* above dashboard content */
    }

    #loading-mask .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #999;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section('content')
    <div class="result-top">
        <h1 class="title breadcrumbs">
            @foreach ($breadcrumbs as $crumb)
                @if (is_array($crumb))
                    <a href="{{ $crumb['href'] ?? '' }}">{{ $crumb['name'] ?? 'Error' }}</a>
                @else
                    {!! $crumb !!}
                @endif
                @if (!$loop->last)
                    &gt;
                @endif
            @endforeach
        </h1>
    </div>

    <div class="search_result_main product_{{ $product_id }}">
        <div class="load-mask"></div>
        <div class="dash-top">
            <div><b><a class="edit-search-link" href="{{ url()->previous() }}">Edit Search</a> | {{ $search }}</b></div>
        </div>
        @if (count($results))
            <div class="search_result_filter">
                <div class="search_result_filter_section product_{{ $product_id }}">
                    <span class="search_result_filter_text">Filter results by media:</span>
                    <div onclick="filterResult('all')" class="search_result_filter_icon all active">
                        <!--<img src="/images/all-filter.webp">-->
                        <div class="filter_label">All</div>
                    </div>
                    @if ($type_count[10] ?? 0)
                        <div onclick="filterResult('pdf')" class="search_result_filter_icon pdf">

                            <div class="filter_label">Factsheet</div>
                        </div>
                    @endif
                    @if ($type_count[4] ?? 0)
                        <div onclick="filterResult('photos')" class="search_result_filter_icon photos">

                            <div class="filter_label">Photos</div>
                        </div>
                    @endif
                    @if ($type_count[7] ?? 0)
                        <div onclick="filterResult('vrtour')" class="search_result_filter_icon vrtour">

                            <div class="filter_label">VRTour</div>
                        </div>
                    @endif
                    @if ($type_count[9] ?? 0)
                        <div onclick="filterResult('video')" class="search_result_filter_icon video">

                            <div class="filter_label">Video</div>
                        </div>
                    @endif
                    <div class="filter_view_icon_container">
                        <div class="filter_view_icon filter_thumb active product_{{ $product_id }}" title="Grid View"
                            onclick="hide_view('thumb')">
                            <img alt="" src="/images/Icon-GridView.svg" />
                        </div>
                        <div class="filter_view_icon filter_list product_{{ $product_id }}" title="List View"
                            onclick="hide_view('list')">
                            <img alt="" src="/images/Icon-ListView.svg" />
                        </div>
                    </div>
                </div>


            </div>
            <div class="search_border"></div>
        @endif
        @if ($query && !count($results))
            <div class="no-search-results">
                No results found for &lsquo;{{ $query }}&rsquo;
            </div>
        @endif

        <div class="dash-content thumb_view num_results_{{ count($results) }}"> {{-- dash content --}}

            <div class="loader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>

            @php($count = 0)
            @foreach ($categories as $key => $category)
                @if (in_array($category->id, $cat_id))
                    <div class="container-fluid-custom"> {{-- container fluid --}}
                        <div id="recipeCarousel_{{ $count }}" data-ride="ke-carousel" data-interval="99999999999"
                            class="kings-carousel type-row carousel_{{ $count }} ke-carousel ke-slide"
                            data-type-id="{{ $category->id }}">
                            <div class="heading">{{ $category->name }}</div>
                            <div class="grid key-contacts ke-carousel-inner ke-row" role="listbox">
                                @php($first = true)
                                @foreach ($results as $asset)
                                    @if ($category->id == $asset->asset_category_id)
                                        <div class="grid-item asset-item ke-carousel-item @if ($first) active @php($first = false) @endif"
                                            data-item-asset-id="{{ $asset->type->id }}"
                                            data-asset-id="{{ $asset->id }}"
                                            data-asset-type="{{ $asset->asset_category_id }}">
                                            @if (isset($asset->type->icon))
                                                <div
                                                    class="asset-type-icon product_{{ $product_id }} type_{{ $asset->type->id }}">
                                                </div>
                                                <div class="asset_type_name product_{{ $product_id }}">
                                                    <span class="inline-type-name">
                                                        @if ($asset->type->id == 5)
                                                            Kings Life
                                                        @elseif($asset->type->id == 6)
                                                            Calendar
                                                        @else
                                                            {{ str_ireplace('Interactive PDF', 'PDF', $asset->type->name) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                            @if ($asset->type->id == 5)
                                                <a
                                                    onclick="javascript: window.open('{{ $asset->getContent(defaultLanguage()->id, defaultVariation()->id) }}', '_blank');">
                                                    <div class="image image_position"
                                                        style="background-image: url('{{ Storage::url($asset->thumb) }}');">
                                                    </div>
                                                    <div class="asset_label text">
                                                        {{ $asset->title }}
                                                    </div>
                                                </a>
                                            @elseif ($asset->type->id == 'factsheet')
                                                <a style="color:black !important;" href="{{ $asset->href ?? '' }}">
                                                    <div class="image image_position"
                                                        style="background-image: url('{{ 'https://kingseducation.com/' . $asset->banner }}');">
                                                    </div>
                                                    <div class="asset_label text">
                                                        {{ $asset->title }}
                                                    </div>
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('getAssetPreviewPage', ['course_category' => $product_id, 'location' => \Illuminate\Support\Str::slug($search, '-'), 'asset_id' => $asset->id]) }}">
                                                    <div class="image image_position"
                                                        style="background-image: url('{{ Storage::url($asset->thumb) }}');">
                                                    </div>
                                                    <div class="asset_label text">
                                                        {{ $asset->title }}
                                                    </div>
                                                </a>
                                            @endif
                                            <input type="hidden" name="included_assets[]" value="{{ $asset->id }}">
                                        </div>
                                        {{--  --}}
                                    @endif
                                @endforeach
                                @if (isset($result_factsheet) && !empty($result_factsheet))
                                    @foreach ($result_factsheet as $asset)
                                        @if ($category->id == $asset->category)
                                            <div class="grid-item asset-item" data-item-asset-id="factsheet"
                                                data-asset-id="{{ $asset->id }}"
                                                data-asset-type="{{ $asset->category }}">
                                                <div class="asset-type-icon product_{{ $product_id }}"></div>
                                                <div class="asset_type_name product_{{ $product_id }}">
                                                    <span class="inline-type-name">Factsheet</span>
                                                </div>
                                                <a style="color:black !important;" href="{{ $asset->href ?? '' }}">
                                                    <div class="image image_position"
                                                        style="background-image: url('{{ 'https://kingseducation.com/' . $asset->banner }}');">
                                                    </div>
                                                    <div class="asset_label text">
                                                        {{ $asset->title }}
                                                    </div>
                                                </a>
                                                <input type="hidden" name="included_assets[]" value="{{ $asset->id }}">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>

                            <a id="ke-carousel-control-prev_{{ $count }}"
                                class="ke-carousel-control-prev product_{{ $product_id }}"
                                data-target="#recipeCarousel_{{ $count }}" role="button" data-slide="prev">

                                <i class="fa fa-chevron-left fa-lg text-muted-custom"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a id="ke-carousel-control-next_{{ $count }}"
                                class="ke-carousel-control-next product_{{ $product_id }}"
                                data-target="#recipeCarousel_{{ $count }}" role="button" data-slide="next">

                                <i class="fa fa-chevron-right fa-lg text-muted-custom"></i>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div> {{-- /container fluid --}}
                    @php($count++)
                @endif
            @endforeach
        </div> {{-- / dash content --}}


        <div class="dash-content list_view product_{{ $product_id }}">
            @php($count = 0)
            @foreach ($categories as $key => $category)
                @if (in_array($category->id, $cat_id))
                    <div class="type-row" data-type-id="{{ $category->id }}">
                        <div class="heading">{{ $category->name }} </div>
                        <div role="listbox">

                            @foreach ($results as $asset)
                                @if ($category->id == $asset->asset_category_id)
                                    <div class="asset-item list_title" data-item-asset-id="{{ $asset->type->id }}"
                                        data-asset-id="{{ $asset->id }}"
                                        data-asset-type="{{ $asset->asset_category_id }}">
                                        <div class="list_view_data product_{{ $product_id }}">
                                            <div
                                                class="asset-type-icon product_{{ $product_id }} type_{{ $asset->type->id }} list_view_icon">
                                            </div>
                                            <div class="inline_name_div product_{{ $product_id }} list_view_wrapper">
                                                <span class="inline-type-name list_view">
                                                    @if ($asset->type->id == 5)
                                                        Kings Life
                                                    @elseif($asset->type->id == 6)
                                                        Calendar
                                                    @else
                                                        {{ $asset->type->name }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="text inline_title list_view">
                                                @if ($asset->type->id == 5)
                                                    <div
                                                        onclick="javascript: window.open('{{ $asset->link }}', '_blank');">
                                                        {{ $asset->title }}
                                                    </div>
                                                @else
                                                    <a style="color:#fff"
                                                        href="{{ route('getAssetPreviewPage', ['course_category' => $product_id, 'location' => $search, 'asset_id' => $asset->id]) }}">
                                                        {{ $asset->title }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" name="included_assets[]" value="{{ $asset->id }}">
                                    </div>
                                @endif
                            @endforeach
                            @if (isset($result_factsheet) && !empty($result_factsheet))
                                @foreach ($result_factsheet as $asset)
                                    @if ($category->id == $asset->category)
                                        <div class="asset-item list_title" data-item-asset-id="factsheet"
                                            data-asset-id="{{ $asset->id }}"
                                            data-asset-type="{{ $asset->category }}">
                                            <div
                                                class="list_view_data product_{{ $product_id }} list-view_icon_wrapper">
                                                <div
                                                    class="asset-type-icon product_{{ $product_id }} list-view_icon_wrapper">
                                                </div>
                                                <div class="inline_name_div list-view product_{{ $product_id }}">
                                                    <span class="inline-type-name list_view_factsheet">Factsheet </span>
                                                </div>
                                                <div class="text inline_title list_view_title">
                                                    <a href="{{ $asset->href }}">{{ $asset->title }}</a>
                                                </div>
                                            </div>

                                            <input type="hidden" name="included_assets[]" value="{{ $fact_id->id }}">
                                            <input type="hidden" name="asset_type_contentType_name" value="factsheet">

                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                    @php($count++)
                @endif
            @endforeach
        </div>
    </div>
    </div>
@endsection

@section('add-js')
    <script type="text/javascript">
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
                        const controlButton = carousel.querySelector(
                            `.ke-carousel-control-${direction}`);
                        if (controlButton) controlButton.click();
                    }
                });
            });


        });

        // outside of domcontent loaded scope
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

        function hide_view(view) {
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

        function getViewMode() {
            let filter_thumb_el = document.querySelector('.filter_thumb');
            if (filter_thumb_el) {
                return filter_thumb_el.classList.contains('active') ? 'thumb' : 'list';
            }
            return 'list';
        }

        function filterResult(filterType) {
            const pageUrl = new URL(window.location.href);
            const viewMode = getViewMode();
            console.log("VIEW MODE", viewMode);

            pageUrl.searchParams.set('filter', filterType);
            const parameter = pageUrl.search; // includes the leading ?

            console.log("FILTER", filterType);

            showLoading();

            fetch("{{ route('do-kings-search-new') }}" + parameter, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.text())
                .then(data => {
                    document.querySelector('.sidebar').style.display = 'none';
                    document.body.innerHTML = data;
                    window.history.replaceState(null, null, pageUrl);
                    filterResultData(filterType);
                    let toggleView = (viewMode != 'thumb') ? 'list' : 'thumb';
                    hide_view(toggleView);
                })
                .finally(() => {
                    hideLoading();
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

            if (filterType == 'all') {
                return;
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
                let gridItems = row.querySelector('.grid .asset-item');
                if (!gridItems) {
                    return;
                }
                if (gridItems.children.length === 0) {
                    row.remove();
                }
            });

            listRows.forEach(row => {
                let listItems2 = row.querySelector('.asset-item');
                if (!listItems2) {
                    return;
                }
                if (listItems2.children.length === 0) {
                    row.remove();
                }
            });
        }

        function showLoading() {
            injectLoader();
            let mask = document.getElementById('loading-mask');
            if (mask) {
                document.getElementById('loading-mask').style.display = 'flex';
            }
        }

        function hideLoading() {
            let mask = document.getElementById('loading-mask');
            if (mask) {
                document.getElementById('loading-mask').style.display = 'none';
            }
        }

        function injectLoader() {
            if (document.getElementById('loading-mask')) {
                return;
            }
            const dashboard = document.querySelector('.dashboard');
            if (dashboard) {
                dashboard.insertAdjacentHTML('afterbegin',
                    `<div id="loading-mask"><div class="loading-spinner"></div></div>`);
            }
        }
    </script>
@endsection
