<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="widgets/../../index.html">Majent Tenant Portal</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">{{$notification->count}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <div id="notifs">
                                <ul id='notifBody' class="menu" style="overflow: hidden; ">
                                    @foreach($notification->list as $notif)
                                    <li>
                                        <a href="{{$notif->link}}" id = '{{$notif->id}}' class = "notification waves-effect waves-block">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>{{$notif->title}}</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> {{$notif->date_issued}}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View All Notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <li class="pull-right"><a href="javascript:void(0);"><i class="material-icons">input</i></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('images/users/'.Auth::user()->picture) }}" class = "user-image" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->first_name }} {{Auth::user()->last_name}}</div>
                <div class="email">{{Auth::user()->email}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header active">MAIN NAVIGATION</li>
                <li>
                    <a href="{{route('tenant.home')}}"><i class="fa fa-fw fa-home fa-2x"></i> <span>Home</span></a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-fw fa-home fa-2x"></i>
                        <span>Transactions</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="{{route('offerSheetApproval.index')}}"><i class="fa fa-fw fa-home fa-2x"></i>Offer Sheet Approval</a></li>
                        <li><a href="{{route('registrationForfeit.index')}}"><i class="fa fa-fw fa-home fa-2x"></i>Registration Forfeit</a></li>
                        <li><a href="{{route('tenant.requestUnit')}}"><i class="fa fa-fw fa-home fa-2x"></i>Request New Units</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-fw fa-home fa-2x"></i>
                        <span>Contracts</span>
                    </a>
                    <ul class = "ml-menu">
                        <li><a href="{{route('contract.index')}}"><i class="fa fa-fw fa-home fa-2x"></i>Accept Contracts</a></li>
                        <li><a href="{{route('tenant.contractView')}}"><i class="fa fa-fw fa-home fa-2x"></i>Manage Ongoing Contracts</a></li>
                        <li><a href="{{route('tenant.terminateContract')}}"><i class="fa fa-fw fa-home fa-2x"></i>Terminate Contracts</a></li>
                        <li><a href="{{route('tenant.contract.extend.index')}}"><i class="fa fa-fw fa-home fa-2x"></i>Manage Ongoing Contracts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-fw fa-home fa-2x"></i>
                        <span>
                            {{Auth::user()->first_name }} {{Auth::user()->last_name}}</span>
                        </a>
                        <ul class ="ml-menu">
                            <li><a href="{{route('tenant.account.index')}}"><i class="fa fa-fw fa-cog fa-2x"></i> Manage Account</a></li>
                            <li><a onclick="showWithdrawModal()" id = 'btnShowWithdrawModal' data-toggle="modal" href='#withdrawModal'><i class="fa fa-fw fa-money fa-2x"></i> Balance:
                                <span class="label label-primary" id = 'balance'></span>
                            </a></li>
                            <li><a href="{{route('account.notification.index')}}"><i class="fa fa-fw fa-sign-out fa-2x"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>