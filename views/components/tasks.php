
<?php 
    if(!empty($_SESSION['user_tasks'])){

        echo "<ul class='collapsible'>";
        foreach($_SESSION['user_tasks'] as $tasks) {
            echo "<li>
            <div class='collapsible-header'><i class='material-icons'>filter_drama</i>".$tasks['title']."</div>
                <div class='collapsible-body'>
                    <span>".$tasks['description']."</span>
                    <br />
                    <button class='btn modal-trigger red accent-3'>Delete task</button>
                </div>
            </li>";
        }
        echo "</ul>";
    }
?>
