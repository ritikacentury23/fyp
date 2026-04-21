<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">{{ config('app.name') }}
            </span>
        </a>

        <ul class="sidebar-nav">


            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{route('admin')}}">
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('banner.index')}}">
                    <span class="align-middle">Banners</span>
                </a>
            </li>






            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('product.index')}}">
                    <span class="align-middle">Products</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('category.index')}}">
                    <span class="align-middle">Category</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('brand.index')}}">
                    <span class="align-middle">Brand</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('order.index')}}">
                    <span class="align-middle">Order Details</span>
                </a>
            </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('review.index')}}">
                     <span class="align-middle">Product Review</span>
                </a>
            </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('aboutus.index')}}">
                     <span class="align-middle">About Us</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('contacts.index') }}">
                    <span class="align-middle">Contact Us Data</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.blog.index') }}">
                    <span class="align-middle">Blog Posts</span>
                </a>
            </li>

        </ul>


    </div>
</nav>