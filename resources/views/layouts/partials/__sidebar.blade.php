<!--  BEGIN TOPBAR  -->
<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="list-unstyled menu-categories" id="topAccordion">

            <li class="menu single-menu">
                <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                    <div class="">
                        <i data-feather="user"></i>
                        <span>Users</span>
                    </div>
                    <i data-feather="chevron-down"></i>
                </a>
                <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                    <li>
                        <a href="{{route('user.index')}}">Users</a>
                    </li>
                    <li>
                        <a href="{{route('country.index')}}">Countries</a>
                    </li>
                </ul>
            </li>
            <li class="menu single-menu">
                <a href="{{route('category.index')}}">
                    <div class="">
                        <i data-feather="layers"></i>
                        <span>Category</span>
                    </div>
                </a>
            </li>
            <li class="menu single-menu">
                <a href="{{route('post.index')}}">
                    <div class="">
                        <i data-feather="layers"></i>
                        <span>Post</span>
                    </div>
                </a>
            </li>
            <li class="menu single-menu">
                <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                    <div class="">
                        <i data-feather="send"></i>
                        <span>Comments</span>
                    </div>
                    <i data-feather="chevron-down"></i>
                </a>
                <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                    <li>
                        <a href="{{route('comment.index')}}">Comments</a>
                    </li>
                    <li>
                        <a href="{{route('reply.index')}}">Replies</a>
                    </li>
                </ul>
            </li>

            <li class="menu single-menu">
                <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>Groups</span>
                    </div>
                    <i data-feather="chevron-down"></i>
                </a>
                <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                    <li>
                        <a href="{{route('group.index')}}">Groups</a>
                    </li>
                    <li>
                        <a href="{{route('group-user.create')}}">Group User</a>
                    </li>
                </ul>
            </li>

            <li class="menu single-menu">
                <a href="{{route('message.index')}}">
                    <div class="">
                        <i data-feather="message-square"></i>
                        <span>Messages</span>
                    </div>
                </a>
            </li>
            <li class="menu single-menu">
                <a href="{{route('family.index')}}">
                    <div class="">
                        <i data-feather="message-square"></i>
                        <span>Family Blog</span>
                    </div>
                </a>
            </li>

            <li class="menu single-menu">
                <a href="{{route('ads.index')}}">
                    <div class="">
                        <i data-feather="message-square"></i>
                        <span>Ads</span>
                    </div>
                </a>
            </li>
            <li class="menu single-menu">
                <a href="{{route('activity.index')}}">
                    <div class="">
                        <i data-feather="message-square"></i>
                        <span>Activities</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!--  END TOPBAR  -->
