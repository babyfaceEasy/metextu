<div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-25">
                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Quick Link <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                  <ul class="dropdown-menu drop-menu-right" role="menu">
                    
                <li>
                    <a href="{{ route('home') }}"> Dashboard  </a>                              
                </li>

        <li >
            <a href="{{ route('create.sms') }}">Send Sms</a>
            
        </li>

        <li>
            <a href="{{ route('groups.index') }}" >Address Book  </a>
            
        </li>

        <li>
            <a href="{{ route('credit.page') }}">Buy Credits </a>
            
        </li>

        <li>
            <a href="{{ route('transfer.page') }}" >Transfer Credit </a>
            
        </li>


        <li>
            <a href="sms_log.php"> All Logs</a>
            
        </li>

        <li>
            <a href="{{ route('show.profile') }}">Account Settings</a>
            
        </li>
                    <li class="divider"></li>
                    <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                        </li>
                </ul>
            </div>

            <h4 class="page-title">{{$page_title}} </h4>
            <p class="text-muted page-title-alt"><small>Available Credit Unit <strong>{{ (Auth::user()->credit->units) ? Auth::user()->credit->units : 0.0}}</strong></small></p>
        </div>
    </div>