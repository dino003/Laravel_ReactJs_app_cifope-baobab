<div class="sidebar-menu" style="position: fixed;">

   

    <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span>
            <!--<img id="logo" src="" alt="Logo"/>-->
        </a> </div>
    <div class="menu">
        <ul id="menu" >
           @can('Acceder-A-Son-Profil')
                 <li id="menu-home">
            <a href="{{url('/profil')}}">
                <i class="fa fa-tachometer-alt"></i><span>Accueil</span>

                </a>
               
            </li>

             <li id="menu-home">
            <a href="{{url('/profil_user')}}">
                <i class="fa fa-user"></i><span>Profil</span>

                </a>
               
            </li>

            <li id="menu-home">
            <a href="{{url('/poster_message')}}">
                <i class="fa fa-envelope"></i><span>Poster un message</span>

                </a>
               
            </li>
            @endcan

            @if(Auth::user()->admin)
            <li id="menu-academico" ><a href="#"><i class="fa fa-cogs"></i><span>Organisation</span><span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                @can('Voir-Utilisateur')
                    <li> <a href="{{url('gestion_des_employes_ajax')}}">
                        Gestion des Utilisateurs</a></li>
                        @endcan

                        @can('Voir-Structure')
                    <li id="menu-academico-boletim" ><a href="{{url('ListeStructure')}}">Structure de Découpage de l'Entreprise</a></li>
                    @endcan
                    @can('Affecter-Utilisateur')
                    <li id="menu-academico-avaliacoes" ><a href="{{url('AffectationEmploye')}}">Affectations des utilisateurs</a></li>
                    @endcan

                    @can('Affecter-Document')

                    <li id="menu-academico-avaliacoes" ><a href="{{url('AffectationDocument')}}">Affectations de documents</a></li>
                     @endcan
                        @can('Voir-Role')
                    <li id="menu-academico-avaliacoes" ><a href="{{url('gestion_des_roles')}}">Gestion des Accès</a></li>
                    @endcan

                    <li id="menu-academico-avaliacoes" ><a href="{{url('gestion_des_tracabilites')}}">Gestion de traçabilité</a></li>


                </ul>
            </li>
            <!--
             <router-link tag="li" to="/gestion_des_employes">
                        <a>
                        <i class="fa fa-users"></i><span></span>
                        </a>
                </router-link>
                -->
                <li>
                     <a href="{{url('communaute')}}">
                        <i class="fa fa-tv"></i><span>Communauté de pratiques</span>

                </a>
               
            </li>

            @endif



             
            <li id="menu-academico" ><a href="#"><i class="fa fa-briefcase"></i><span>Mes Dossiers</span><span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                            @can('Voir-Ses-Dossiers-Accessibles')
                <li id="menu-academico" ><a href="{{url('Service')}}"><i class="fa fa-briefcase"></i>
                    <span>Mes Dossiers accéssibles</span></a>
                </li>
                @endcan

                 @can('Voir-Ses-Dossiers-Personnels')
     <li>
    <a href="{{url('Mesdossiers')}}"><i class="fa fa-file-text"></i><span>Mes dossiers Personnels</span></a>
               
    </li>
    @endcan

                      

                </ul>
            </li>
          

            

          
    <!--
             <li id="menu-academico" ><a href="#"><i class="fa fa-file-text"></i><span>Gestionnaire</span><span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-boletim" ><a href="{{url('ListePhoto')}}">Départements && Services</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="{{url('ListeVideo')}}">Gestion des affectations</a></li>
                </ul>
            </li>
-->

             
            <!--
            <li><a href="#"><i class="fa fa-tv"></i><span>Média</span><span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="#">Diffusion/Articles</a></li>
                    <li id="menu-academico-boletim" ><a href="#">Diffusion/Flash infos</a></li>

                </ul>
            </li>

        -->
        <!--
        <router-link tag="li" to="/chat_conversation">
                        <a>
                             <i class="fa fa-comments"></i>
                            <span>Chat</span>
                    </a>
                </router-link>
                -->
                @can('Acceder-Au-Chat')
                <li>
                    <a href="{{url('conversationVue')}}">
                    <i class="fa fa-comments"></i><span>Chat</span></a>
               
            </li>
            @endcan

           

            @can('Voir-Ses-Videos')
             <li>
            <a href="{{url('Mesvideopersonnel')}}">
                <i class="fa fa-tv"></i><span>Mes videos</span>

                </a>
               
            </li>
            @endcan

           

        </ul> 
    </div>
    <!--
     <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                            -->



</div>
