
<?php 

    // THIS PART NEEDS TO BE SECURITY CHECKED!
    // CSRF TOKEN nEEDS TO BE FIXED

    if(!empty($_SESSION['user_tasks'])){

        if(empty($_SESSION['user_tab'])){
            $_SESSION['user_tab'] = "active";
        }

        $user_tab_active = $_SESSION['user_tab'] == 'active' ? 'active': '';
        $user_tab_deleted = $_SESSION['user_tab'] == 'delete' ? 'active': '';
        $user_tab_completed = $_SESSION['user_tab'] == 'complete' ? 'active': '';

        echo "
            <ul class='tabs tabs-fixed-width tab-demo z-depth-1'>
                <li class='tab'><a class='{$user_tab_active}' href='#test1'>Tasks ".$_SESSION['amount_active_tasks']['active_tasks']."</a></li>
                <li class='tab'><a class='{$user_tab_deleted}' href='#test2'>Deleted tasks ".$_SESSION['amount_deleted_tasks']['deleted_tasks']."</a></li>
                <li class='tab'><a class='{$user_tab_completed}' href='#test3'>Completed tasks ".$_SESSION['amount_completed_tasks']['completed_tasks']."</a></li>
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
                            <div style='font-weight:bold; margin-left:15px;' class='collapsible-header'><i class='material-icons red-text accent-3'>delete</i>".$tasks['title']."</div>
                                <div class='collapsible-body'>
                                    <span>".$tasks['description']."</span>
                                    <br />
                                    <form method='post' action='../index.php'>
                
                                        <input type='hidden' name='delete_task' value='".$tasks['id']."'>
                                        <button class='btn modal-trigger red accent-3'>Permanently delete </button>
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
                            <div style='font-weight:bold; margin-left:15px;' class='collapsible-header'><i class='material-icons green-text accent-3'>done</i>".$tasks['title']."</div>
                                <div class='collapsible-body'>
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
