
<?php 

    // THIS PART NEEDS TO BE SECURITY CHECKED!
    // CSRF TOKEN nEEDS TO BE FIXED

    if(!empty($_SESSION['user_tasks'])){

        echo "<ul class='collapsible'>";
        foreach($_SESSION['user_tasks'] as $tasks) {

            $deleted = $tasks['deleted'] ? 'red accent-3' : '';

            echo "<li>
            <div class='collapsible-header ".$deleted."'><i class='material-icons'>filter_drama</i>".$tasks['title']."</div>
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
        echo "</ul>";
    }
?>
