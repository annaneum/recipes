[main]
<div class="jumbotron">
  <h2>{LANG:LOGIN}</h2>
{MSG}
<form method="POST" action="{LINK_URL}login/login">
  <div class="form-group">
    <label for="Username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

[msg]
<div class="alert alert-danger" role="alert">{MSG_TEXT}</div>