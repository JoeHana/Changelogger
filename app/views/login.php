<body class="login">

    <div id="interface" class="uk-animation-scale-up">
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="uk-form">
            
            <header>
                
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div id="logo">
                            <?php echo '<a href="' . $_SERVER['PHP_SELF'] . '">' . APP_TITLE . '</a>'; ?>
                        </div>
                    </div>
                </div>
                
            </header>
    
            <main>
            
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <input type="password" name="password" placeholder="Password" required class="uk-width-1-1 uk-form-large" />
                        <input type="submit" name="submit" value="Login" class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top"/>
                    </div>
                </div>
                                                                    
           </main>
           
        </form>
         
        <?php if($x == 'wp') echo '<div class="uk-alert uk-alert-danger" data-uk-alert><a href="" class="uk-alert-close uk-close"></a><p>Your Password is not correct</p></div>'; ?>
        
    </div>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="<?php echo changelogger_info( 'url' ); ?>/app/assets/js/uikit/uikit.min.js"></script>

</body>
</html>