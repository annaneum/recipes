[main]
<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
  <!-- Brand -->
  <a class="navbar-brand" href="{LINK_URL}index">{LANG:BRAND}</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      {MENU_POINTS}
    </ul>
    <ul class="navbar-nav">
      {MENU_RIGHT_POINTS}
    </ul>
  </div> 
</nav>


[menu_point]
<li class="nav-item">
  <a class="nav-link {ACTIVE}" href="{LINK}">{TEXT}</a>
</li> 
