<body <?PHP if(isset($_GET['fillText'])) echo ' onload="document.getElementById(\'text\').focus();"'; ?>>

    <div id="messages" class="messages">
        <?php echo changelogger_output_errors() ?>
    </div>
    
    <div id="interface">
    
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="uk-form">
            
            <header>
                
                <div class="uk-grid">
                    <div class="uk-width-4-10">
                        <div id="logo">
                            <?php echo '<a href="' . $_SERVER['PHP_SELF'] . '">' . APP_TITLE . '</a>'; ?>
                        </div>
                    </div>
                    <div class="uk-width-3-10">
                        <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" class="uk-width-1-1" />
                    </div>
                    <div class="uk-width-3-10">
                        <input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>" class="uk-width-1-1">
                    </div>
                </div>
                
            </header>
    
            <main data-uk-sticky>
            
                <div class="uk-grid">
                    <div class="uk-width-5-10">
                        <input type="text" name="project" placeholder="Project" value="<?php echo $project; ?>" class="uk-width-1-1 uk-form-large" />
                    </div>
                    <div class="uk-width-5-10">
                        <input type="text" name="version" placeholder="Version" value="<?php echo $version; ?>" class="uk-width-1-1 uk-form-large">
                    </div>
                </div>
        
                <div class="uk-grid uk-margin-top">
                    <div class="uk-width-3-10">
                        <select name="type" class="uk-width-1-1 uk-form-large type" placeholder="Type">;
                        <?php
                        foreach( changelogger_types() as $type ) {
                            
                            if( $lastType == $type ) {
                                $selected = ' selected="selected"';
                            } else {
                                $selected = '';
                            }
                            
                            echo '<option value="' . $type . '"' . $selected . '>' . ucwords( $type ) . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="uk-width-5-10">
                        <input type="text" name="path" placeholder="File name" value="<?php if(isset($_GET['fillPath'])) echo $_GET['fillPath']; ?>" class="uk-width-1-1 uk-form-large" />
                    </div>
                    <div class="uk-width-2-10">
                        <input type="text" name="line" placeholder="Line" value="" class="uk-width-1-1 uk-form-large" />                    
                    </div>
                </div>
                <div class="uk-grid uk-margin-top">
                    <div class="uk-width-1-1">
                        <textarea name="text" id="text" rows="3" placeholder="Description" class="uk-width-1-1 uk-form-large"><?php if(isset($_GET['fillText'])) echo $_GET['fillText']; ?></textarea>
                    </div>
                </div>
                <div class="uk-grid uk-margin-top">
                    <div class="uk-width-1-1">
                        <input name="sub" type="submit" value="Add Log Entry" class="uk-button uk-button-primary uk-button-large uk-width-1-1" />
                    </div>
                </div>
                                                            
           </main>
           
        </form> 
    
        <?php
        
        krsort($log);
        
        //Regarding RE:
        $RElink = FALSE;
        
        if($anchor == FALSE) $useLog = $log;
        else {
            if($anchor[2] != '') {
                $useLog[$anchor[0]] = array($anchor[1] => array($log[$anchor[0]][$anchor[1]][$anchor[2]]));
                $useLog[$anchor[0]] = array($anchor[1] => array('id' => $log[$anchor[0]][$anchor[1]]['id'], $anchor[2] => $log[$anchor[0]][$anchor[1]][$anchor[2]]));
                $RElink = TRUE;
            }
            elseif($anchor[1] != '') $useLog[$anchor[0]] = array($anchor[1] => $log[$anchor[0]][$anchor[1]]);
            else $useLog[$anchor[0]] = $log[$anchor[0]];
        }
        ?>
        
        <div id="options">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="uk-form">
                <div class="uk-button-group" data-uk-button-checkbox>
                    <?php if ($RElink == TRUE) { ?><a class="uk-button uk-button-small" href="<?php echo $_SERVER['PHP_SELF'] . '?fillText=RE:' . urlencode($_GET['anchor'] . ' ') . '&fillPath=' . urlencode($useLog[$anchor[0]][$anchor[1]][$anchor[2]]['path']); ?>">RE:Anchor</a><?php } ?>
                    <a class="uk-button uk-button-small" href="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>">Reload</a>
                    <?php if ($showRE == 0) echo '<a class="uk-button uk-button-small" href="' . $_SERVER['PHP_SELF'] . '?showRE=1&amp;fullPaths=' . $showFullPaths . '&amp;q=' . $q . '">Show Anchors</a>'; else echo '<a class="uk-button uk-button-small" href="' . $_SERVER['PHP_SELF'] . '?showRE=0&fullPaths=' . $showFullPaths . '&q=' . $q . '">Hide Anchors</a>'; ?>
                    <?php if ($showFullPaths == 0) echo '<a class="uk-button uk-button-small" href="' . $_SERVER['PHP_SELF'] . '?fullPaths=1&amp;showRE=' . $showRE . '&amp;q=' . $q . '">Full Paths</a>'; else echo '<a class="uk-button uk-button-small" href="' . $_SERVER['PHP_SELF'] . '?fullPaths=0&showRE=' . $showRE . '&q=' . $q . '">Short Paths</a>'; ?>
                    <a class="uk-button uk-button-small" data-uk-toggle="{target:'#log'}">Changelog</a>
                </div>
    
                <input type="search" name="q" value="<?php if ($q != '') echo str_ireplace('(.*)', ' ', $q); ?>" placeholder="Search ChangeLog" class="uk-align-right uk-form-small">
            </form>
            
        </div>
        
        
        <div id="log" class="uk-hidden">
        
            <?php if(empty($log)) { ?>
            No Entries available
            <?php } ?>
        
            <?php
            //!make GUI
            foreach($useLog as $date => $users) {
                foreach($users as $name => $nodes) {
            
                    //Build Anchors
                    if($showRE == 1) {
                        $dateRE = '[<a href="' . $_SERVER['PHP_SELF'] . '?anchor=' . urlencode($date . '++') . '">#</a>]';
                        $dateNameRE = '[<a href="' . $_SERVER['PHP_SELF'] . '?anchor=' . urlencode($date . '+' . str_ireplace(' ' , '_', $name) . '+') . '">#</a>]';
                    }
                    else {
                        $dateRE = '';
                        $dateNameRE = '';
                    }
            
                    echo '<div class="uk-panel"><span class="entry">' . $date . '' . $dateRE . '  <a href="mailto:' . $nodes['id']['email'] . '">' . $name . '</a></span>' . $dateNameRE . '';
            
                    unset($nodes['id']);
            
                    echo '<ul class="uk-list uk-list-space">';
                    foreach ($nodes as $key => $node) {
                        if (preg_match("/$q/i", implode(' ', $node))) {
            
                            if ($showRE == 1) $dateNameNumRE = '[<a href="' . $_SERVER['PHP_SELF'] . '?anchor=' . urlencode($date . '+' . str_ireplace(' ' , '_', $name) . '+' . $key) . '">#</a>]';
                            else $dateNameNumRE = '';
            
                            //REed?
                            $REed = '';
                            if (isset($REmatch[$date][$name][$key])) { if ($REmatch[$date][$name][$key] == TRUE) $REed = ' class="re"'; }
            
                            echo '<li' . $REed . '>' . $dateNameNumRE ;
            
                            //show type
                            if( $node['type'] ) {
                                echo '<span class="badge badge-' . strtolower( $node['type'] ) . '">[' . $node['type'] . ']</span>';
                            }
                                        
                            //show text
                            if (preg_match("/re:[a-z0-9\-\+\_]+/i", $node['text'], $match)) { $node['text'] = str_ireplace($match[0], 'RE:[<a href="' . $_SERVER['PHP_SELF'] . '?anchor=' . urlencode(str_ireplace('re:', '', $match[0])) . '">#</a>]', $node['text']); }
            
                            if ($node['type'] == 'note') $font = 'italic'; else $font = 'inherit';
                            echo '<span>' . $node['text'] . '</span><br>';
            
                            echo '<span class="log-entry-path-line uk-text-small">';
                            
                            //show path
                            $eachPath2 = array();
                            $pathEcho = 'in <span class="path">';
            
                            if (stripos($node['path'], '&') === false) {
                                if ($showFullPaths == 0) {
                                    $path = explode("/", "//" . $node['path']);
                                    $pathEcho .= $path[(count($path)-2)] . '/' . end($path);
                                }
                                else $pathEcho .= $node['path'];
                            }
                            else {
                                $eachPathFull = explode(' & ', $node['path']);
                                foreach ($eachPathFull as $pathFull) {
                                    if ($showFullPaths == 0) {
                                        $pathFull = explode("/", "//" . $pathFull);
                                        $eachArr[] = $pathFull[(count($pathFull)-2)] . '/' . end($pathFull);
                                    }
                                    else $eachArr[] = $pathFull;
                                }
                                $pathEcho .= implode(' & ', $eachArr);
                            }
            
                            echo $pathEcho . '</span>';
            
                            //show line
                            if ($node['line'] != "") echo ' on line <span class="line">' . $node['line'] . '</span>';
                        
                            echo '</span>';
                            
                            echo '</li>';
                        }
                    }
                    echo '</ul>';
                }
            
                echo '</div>';
            }
            ?>
            
        </div>
    
    </div>

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="<?php echo APP_BASE_URL; ?>/app/assets/js/uikit/uikit.min.js"></script>
    <script src="<?php echo APP_BASE_URL; ?>/app/assets/js/uikit/addons/notify.min.js"></script>
    <script src="<?php echo APP_BASE_URL; ?>/app/assets/js/uikit/addons/sticky.min.js"></script>
    <script src="<?php echo APP_BASE_URL; ?>/app/assets/js/init.js"></script>
    
</body>