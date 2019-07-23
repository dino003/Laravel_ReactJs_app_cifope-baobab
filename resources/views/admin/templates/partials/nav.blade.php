<div class="header-main">
    <div class="header-left">
        <div class="logo-name">
            <a href="#"> <h1>Kognishare</h1>
                <!--<img id="logo" src="" alt="Logo"/>-->
            </a>
        </div>
        <!--search-box-
        <div class="search-box">
            <form>
                <input type="text" placeholder="Search..." required="">
                <input type="submit" value="">
            </form>
        </div>//end-search-box-->
        <div class="clearfix"> </div>
    </div>
    <div class="header-right">

                            @guest
                                <span><a href="{{('/')}}"><i class="fa fa-user"></i> Déconnexion</a> </span>
                                @else
                                <span>
                                <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        
                                </span>
                                @endguest        <!-- notification start
        <div class="profile_details_left">
            <ul class="nofitications-dropdown">

                <li class="dropdown head-dpdn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="notification_header">
                                <h3>You have 3 new messages</h3>
                            </div>
                        </li>
                        <li><a href="#">
                                <div class="user_img"><img src="images/p4.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor</p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li class="odd"><a href="#">
                                <div class="user_img"><img src="images/p2.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor </p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li><a href="#">
                                <div class="user_img"><img src="images/p3.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor</p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li>
                            <div class="notification_bottom">
                                <a href="#">See all messages</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown head-dpdn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="notification_header">
                                <h3>You have 3 new notification</h3>
                            </div>
                        </li>
                        <li><a href="#">
                                <div class="user_img"><img src="images/p5.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor</p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li class="odd"><a href="#">
                                <div class="user_img"><img src="images/p6.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor</p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li><a href="#">
                                <div class="user_img"><img src="images/p7.png" alt=""></div>
                                <div class="notification_desc">
                                    <p>Lorem ipsum dolor</p>
                                    <p><span>1 hour ago</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </a></li>
                        <li>
                            <div class="notification_bottom">
                                <a href="#">See all notifications</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown head-dpdn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-comments"></i><span class="badge blue1">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="notification_header">
                                <h3>You have 8 pending task</h3>
                            </div>
                        </li>
                        <li><a href="#">
                                <div class="task-info">
                                    <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="progress progress-striped active">
                                    <div class="bar yellow" style="width:40%;"></div>
                                </div>
                            </a></li>
                        <li><a href="#">
                                <div class="task-info">
                                    <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="progress progress-striped active">
                                    <div class="bar green" style="width:90%;"></div>
                                </div>
                            </a></li>
                        <li><a href="#">
                                <div class="task-info">
                                    <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="progress progress-striped active">
                                    <div class="bar red" style="width: 33%;"></div>
                                </div>
                            </a></li>
                        <li><a href="#">
                                <div class="task-info">
                                    <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="progress progress-striped active">
                                    <div class="bar  blue" style="width: 80%;"></div>
                                </div>
                            </a></li>
                        <li>
                            <div class="notification_bottom">
                                <a href="#">See all pending tasks</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"> </div>
        </div>
        -->
        <!--notification menu end -->
        <div class="profile_details">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">
                            <span class="prfil-img img-circle">
                                
                                <img src="{{Auth::user()->avatar()}}" alt="Photo de profil" width="50px">
                                <i class="fa fa-pencil-alt" title="Changer la photo de profil" id="photoPencil"></i>

                                
                                 <form enctype="multipart/form-data" id="photo-form" action="{{ route('changer.photo') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="file" name="photo" id="photo" style="display:none;" onchange="this.form.submit();">
                                <!--<button type="submit"> envoyer</button>-->


                            </form>

                             </span>
                            <div class="user-name">
                                <p>{{Auth::user()->userName()}}</p>
                               

                            </div>
                            <!--
                            <i class="fa fa-angle-down lnr"></i>
                            <i class="fa fa-angle-up lnr"></i>
                            -->
                            <div class="clearfix"></div>
                        </div>
                    </a>
                  
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>