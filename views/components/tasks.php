
<?php 

    // THIS PART NEEDS TO BE SECURITY CHECKED!
    // CSRF TOKEN nEEDS TO BE FIXED

    if(!empty($_SESSION['user_tasks'])){

        if(empty($_SESSION['USER_TAB'])){
            $_SESSION['user_tab'] = "active";
        }

        echo "
            <ul class='tabs tabs-fixed-width tab-demo z-depth-1'>
                <li class='tab'><a href='#test1'>Tasks ".$_SESSION['amount_active_tasks']['active_tasks']."</a></li>
                <li class='tab'><a href='#test2'>Deleted tasks ".$_SESSION['amount_deleted_tasks']['deleted_tasks']."</a></li>
                <li class='tab'><a href='#test3'>Completed tasks ".$_SESSION['amount_completed_tasks']['completed_tasks']."</a></li>
            </ul>
            <div id='test1' class='col s12'>";

                echo "<ul class='collapsible'>";
                foreach($_SESSION['user_tasks'] as $tasks) {
        
                    $deleted = $tasks['deleted'] ? 'red accent-3' : '';
        
                    if(!$tasks['deleted'] && !$tasks['completed']) {
                        echo "<li>
                        <div class='collapsible-header".$deleted."'>
                        <span style='font-weight:bold; margin-left:15px;'>".$tasks['title']."</span>
                        </div>
                            <div class='collapsible-body ".$deleted."'>
                                <span>".$tasks['description']."</span>
                                <br />

                                <br />

                                <form style='display:inline-block;' method='post' action='../index.php'>
                                    <input type='hidden' name='complete_task' value='".$tasks['id']."'>
                                    <button class='btn modal-trigger green accent-3'><i class='material-icons'>done</i></button>
                                </form>

                                <form style='display:inline-block;' method='post' action='../index.php'>
                                    <input type='hidden' name='delete_task' value='".$tasks['id']."'>
                                    <button class='btn modal-trigger  red accent-3'><i class='material-icons'>delete</i></button>
                                </form>

                            </div>
                        </li>";
                        }
                    
                }
                echo "</ul>";

                echo "</div>
                <div id='test2' class='col s12'>";

                    echo "<ul class='collapsible'>";
                    foreach($_SESSION['user_tasks'] as $tasks) {
            
                        $deleted = $tasks['deleted'] ? 'red accent-3' : '';
            
                        if($tasks['deleted']) {
                            echo "<li>
                            <div class='collapsible-header ".$deleted."'><i class='material-icons'>place</i>".$tasks['title']."</div>
                                <div class='collapsible-body ".$deleted."'>
                                    <span>".$tasks['description']."</span>
                                    <br />
                                    <form method='post' action='../index.php'>
                
                                        <input type='hidden' name='delete_task' value='".$tasks['id']."'>
                                        <button class='btn modal-trigger red accent-3'>Delete task</button>
                                    </form>
                                </div>
                            </li>";
                        }
                        
                    }
                    echo "</ul>";
                
                echo "</div>";

                echo "<div id='test3' class='col s12'>";

                    echo "<ul class='collapsible'>";
                    foreach($_SESSION['user_tasks'] as $tasks) {
            
                        $completed = $tasks['completed'] ? 'green accent-3' : '';
            
                        if($tasks['completed'] && !$tasks['deleted']) {
                            echo "<li>
                            <div class='collapsible-header ".$completed."'><i class='material-icons'>place</i>".$tasks['title']."</div>
                                <div class='collapsible-body ".$completed."'>
                                    <span>".$tasks['description']."</span>
                                    <br />
                                    <form method='post' action='../index.php'>
                                        <input type='hidden' name='delete_task' value='".$tasks['id']."'>
                                        <button class='btn modal-trigger red accent-3'>Delete task</button>
                                    </form>
                                </div>
                            </li>";
                            }
                        
                    }
                    echo "</ul>";
                
                echo "</div>";
        
    }
?>
