@extends('admin.templates.main')

@section('content')
<link rel="stylesheet" href="{{asset('css/chats/profil.css')}}">
<style>
  

</style>

<div class="dashboard">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="dashboard-tabs">
                <li class="active">
                    <a href="#profile" class="btn" aria-controls="profile" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-user"></span>
                        <h4>Profil</h4>
                    </a>
                </li>
                <li>
                    <a href="#documents" class="btn" aria-controls="documents" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <h4>Documents</h4>
                    </a>
                </li>
                <li>
                    <a href="#donate" class="btn" aria-controls="donate" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-tasks"></span>
                        <h4>A Faire</h4>
                    </a>
                </li>
                <li>
                    <a href="#settings" class="btn" aria-controls="settings" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-cog"></span>
                        <h4>Paramètres</h4>
                    </a>
                </li>
                <li>
                    <a href="#help" class="btn" aria-controls="help" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-question-sign"></span>
                        <h4>Aide</h4>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content col-md-12">
            <div role="tabpanel" class="tab-pane profile-pane active" id="profile">
                <div>
                    <div>
                        <div class="header">
                            <h4>Profile Information</h4>   
                        </div>
                        <div class="content">
                            <div class="row">
                                <img class="col-sm-3 col-sm-offset-1" src="http://lorempixel.com/420/420/city">
                                <div class="col-sm-4">
                                    <h4>[Name]</h4>
                                    <h4>[Type]</h4>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-lg btn-primary pull-right"><span class="glyphicon glyphicon-edit"></span></button>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="col-sm-3 col-sm-offset-1 col">[X] Followers</h4>
                                <h4 class="col-sm-4 col">[X] Votes</h4>
                                <button class="col-sm-3 btn btn-primary col"><h4>[X] Requests</h4></button>
                                
                                <h3 class="col-sm-10 col-sm-offset-1 title">Supported Causes</h3>
                                <div id="supportedCauses" class="col-sm-10 col-sm-offset-1">
                                    <div id="pane1" class="cause-info">
                                        <div>
                                            <img src="http://lorempixel.com/420/420/people">
                                            <div>
                                                <h4>[Name]</h4>
                                                <h4>[Type]</h4>
                                            </div>
                                            <div>
                                                <h4>[X] Votes</h4>
                                            </div>
                                        </div>
                                        <div>
                                            <h4>About:</h4>
                                            <div>
                                                <p>Nam ex ullum assum apeirian, facilisi splendide quo ex. Sea et nonumy accusata, in utinam vocent facilis vix. Cu vix eripuit temporibus mediocritatem, denique theophrastus ne mel, et graecis maiorum mediocritatem per. Magna tacimates sed eu, sit no graeco latine referrentur. Id sed assum quaerendum, apeirian erroribus ut his. Ex mei mazim minimum.</p>
                                                <h5>More at <a>[Website]</a></h5>
                                            </div>
                                            <button class="btn btn-primary pull-right">Give</button>
                                        </div>
                                        <div>
                                            <h2><a class="toggle-handle" href="#pane1" data-area="pane1"><span class="glyphicon glyphicon-chevron-down"></span></a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="header">
                            <h4>Account Information</h4>   
                        </div>
                        <div class="content">
                            <div class="row">
                                <h3 class="col-sm-10 col-sm-offset-1 title">Dwolla</h3>
                                <article class="col-sm-10 col-sm-offset-1">
                                    <p>Esse nostro pertinacia nam te. Erant omnes semper ex has, qui at illum dolor vivendum. Utinam phaedrum expetendis mel ex, purto maluisset et est. Assum labores mea te, ut patrioque liberavisse nec, nec ad inani simul.</p>
                                    <p>In eos insolens partiendo rationibus, te nostrud accusam sapientem quo. Sit semper vivendo corpora in, facilis recusabo has id. Ut vis molestiae intellegebat. An eam etiam essent. Sit in saepe dicam.</p>
                                </article>
                                
                                <h3 class="col-sm-10 col-sm-offset-1 title">Donation Reciepts</h3>
                                <div class="col-sm-5 col-sm-offset-4 search-bar">
                                    <input type="text">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                                <select class="col-sm-2 search-select">
                                    <option>Year</option>
                                    <option>Month</option>
                                    <option>Recent</option>
                                </select>
                                
                                <div class="col-sm-10 col-sm-offset-1 reciept-infos">
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                </div>
                                
                                <h3 class="col-sm-10 col-sm-offset-1 title">Membership</h3>
                                <div class="col-sm-4 col-sm-offset-1 membership-info">
                                    <h4>Membership Info</h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Change Membership</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           <div role="tabpanel" class="tab-pane profile-pane" id="documents">
                <div>
                    <div>
                        <div class="header">
                            <h4>Documents récents</h4>   
                        </div>
                        <div class="content">
                            <div class="row">
                                <img class="col-sm-3 col-sm-offset-1" src="http://lorempixel.com/420/420/city">
                                <div class="col-sm-4">
                                    <h4>[Name]</h4>
                                    <h4>[Type]</h4>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-lg btn-primary pull-right"><span class="glyphicon glyphicon-edit"></span></button>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="col-sm-3 col-sm-offset-1 col">[X] Followers</h4>
                                <h4 class="col-sm-4 col">[X] Votes</h4>
                                <button class="col-sm-3 btn btn-primary col"><h4>[X] Requests</h4></button>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="header">
                            <h4>Tous les documents  <input type="text" placeholder="Rechercher ..." style="color: #414141;">
                                    </h4>   
                        </div>
                        <div class="content">
                            <div class="row">
                              
                                
                                <h3 class="col-sm-10 col-sm-offset-1 title">Donation Reciepts</h3>
                                <div class="col-sm-5 col-sm-offset-4 search-bar">
                                    <input type="text">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                                <select class="col-sm-2 search-select">
                                    <option>Year</option>
                                    <option>Month</option>
                                    <option>Recent</option>
                                </select>
                                
                                <div class="col-sm-10 col-sm-offset-1 reciept-infos">
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <img src="http://lorempixel.com/420/420/people">
                                        <div>
                                            <h4>[Name]</h4>
                                            <h4>[Type]</h4>
                                        </div>
                                    </div>
                                </div>
                                
                               
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="donate">
            Pas encore terminé
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
            Pas encore terminé
            </div>
            <div role="tabpanel" class="tab-pane help-pane" id="help">
            <!-- Begin Help -->
               Pas encore terminé
            <!-- End Help -->
            </div>
        </div>
    </div>
</div>

@endsection