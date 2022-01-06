
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
            </ul>
            <div id='test1' class='col s12'>";

                echo "<ul class='collapsible'>";
                foreach($_SESSION['user_tasks'] as $tasks) {
        
                    $deleted = $tasks['deleted'] ? 'red accent-3' : '';
        
                    if(!$tasks['deleted']) {
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
        
    }
?>
