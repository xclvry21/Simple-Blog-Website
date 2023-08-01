<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('blog.index') }}">
                        <i class="ri-home-2-line"></i>
                        <span>Home</span>
                    </a> 
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-sticky-note-line"></i>
                        <span>Posts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('post.index')}}">All Posts</a></li>
                        <li><a href="{{ route('post.create') }}">Create Post</a></li>                        
                    </ul>
                </li>

                <li class="menu-title">Miscellaneous</li>
                <li>
                    <a href="{{ route('post.trash') }}">
                        <i class="ri-delete-bin-line"></i>
                        <span>Trash</span>
                    </a> 
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>