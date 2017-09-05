<header>
    <button type="button" name="button" class="panel_control" id="panel_control_toggle"><i class="fa fa-bars"></i></button>
    <img src="favicon.png" alt="Content Goblin">
    <h2>Content Goblin</h2>
    <?php echo "<span class='user_panel'><span><i class='fa fa-user-o user_icon'></i> ".$_SESSION['uid']."<a href='logout.inc.php' class='logout'><i class='fa fa-sign-out user_logout'></i></a></span></span>"; ?>
</header>