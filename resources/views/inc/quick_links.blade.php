<div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-25">
                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Quick Link <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                  <ul class="dropdown-menu drop-menu-right" role="menu">
                    
                <li>
                  <a href="index.php"> Dashboard  </a>                              
                </li>

        <li >
            <a href="send_sms.php">Send Sms</a>
            
        </li>

        <li>
            <a href="address_book.php" >Address Book  </a>
            
        </li>

        <li>
            <a href="buy_credit.php">Buy Credits </a>
            
        </li>

        <li>
            <a href="transfer_credit.php" >Transfer Credit </a>
            
        </li>


        <li>
            <a href="sms_log.php"> All Logs</a>
            
        </li>

        <li>
            <a href="settings.php">Account Settings</a>
            
        </li>
                    <li class="divider"></li>
                    <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                        </li>
                </ul>
            </div>

            <h4 class="page-title">Send SMS </h4>
            <p class="text-muted page-title-alt"><small>Available Credit Unit <strong>40</strong></small></p>
        </div>
    </div>