            <ul id="de-contacts">
              @forelse($employeRecherches as $employe)
                <li class="contact ">
                    <div class="wrap">
                      @if($employe->isOnline())
                          <span class="contact-status online"></span>

                           @else
                            <span class="contact-status busy"></span>

                          @endif
                                <img src="{{$employe->photo}}" alt="" />
                        <div class="meta">
                          <a href="{{url('/chat_conversation', $employe->id)}}" style="text-decoration: none; color: #fff;">
                            <p class="name">
                              <?php 
                                  $nouveauxMessage = Auth::user()->messageNouLu($employe->id);

                                         ?>
                                        {{$employe->userName(40)}}
                                        @if($nouveauxMessage === 0)
                                        <strong class="badge badge-error pull-right">{{$nouveauxMessage}}
                                    </strong>
                                    @endif                              
                            </p>
                            <p class="preview">You just got LITT up, Mike.</p>
                          </a>
                        </div>
                    </div>
                </li>
                @empty
                <li class="contact">Aucun résultat</li>
                @endforelse
                
            </ul>





            
        