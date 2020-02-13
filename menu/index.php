<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Sign In!</title>
</head>

<body>
    <div class="container">
        <h1>Sign In</h1>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <div class="form-group row">
                <select class="custom-select" name="permission">
                    <option selected>Sign In As:</option>
                    <option value="1">User</option>
                    <option value="2">Admin</option>
                    <option value="3">Director</option>
                </select>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </div>
        </form>

<?php
require "config.php";
require "db.php";

function make_menu($parent_array, $sub_array)
{
    $menu = "<nav class='nav nav-pills flex-column'>";
        foreach ($parent_array as $key => $val) {
            if (!empty($val['count'])) {
                $menu .= " <a class='nav-link' href=\"".$val['link']."\">".$val['label']."</a>";
            } else {
                $menu .= " <a class='nav-link' href=\"".$val['link']."\">".$val['label']."</a>";
            }
            $menu .= "<nav class='nav nav-pills flex-column'>";            
            foreach ($sub_array as $sval) {
                if ($key == $sval['parent']) {
                    $menu .= "<a class='nav-link ml-5' href=''>".$sval['label']."</a>";
                }
            }
            $menu .= "</nav>";
        }
    $menu .= "</nav>";
    return $menu;
}

function prepareMenu($menu)
{
    if (is_array($menu)) {
        $parent_menu = array();
        $sub_menu = array();
        
        foreach ($menu as $m) {
            if ($m['parent_id']==0) {
                $parent_menu[$m['id']]['label'] = $m['label'];
                $parent_menu[$m['id']]['link'] = $m['link'];
            } else {
                $sub_menu[$m['id']]['parent'] = $m['parent_id'];
                $sub_menu[$m['id']]['label'] = $m['label'];
                $sub_menu[$m['id']]['link'] = $m['link'];
                if (empty($parent_menu[$m['parent_id']]['count'])) {
                    $parent_menu[$m['parent_id']]['count'] = 0;
                }
                $parent_menu[$m['parent_id']]['count']++;
            }
        }
    } 
    return [$parent_menu, $sub_menu];
}

session_start();

if(isset($_POST['permission'])) {
    $permission = $_POST['permission'];
    $_SESSION["usertype"] = $permission;
    
    switch ($_SESSION["usertype"]) {
        case 1:
            $sql = "SELECT * FROM menu WHERE permission = 1 or permission = 0";
            $user = "User";
            break;
        case 2:
            $sql = "SELECT * FROM menu WHERE permission = 2 or permission = 1 or permission = 0";
            $user = "Admin";
            break;
        case 3:
            $sql = "SELECT * FROM menu WHERE permission = 0 or permission = 2";
            $user = "Director";
            break;
        default:
            if(isset($_SESSION["usertype"])){
                unset($_SESSION["usertype"]);
            }
            break;
    }
    
    $con = new DB();
    $menu = $con->get($sql);
    
    echo "<a class='navbar-brand' href='#'>Hello ".$user."!</a>";
    echo "<nav class='navbar navbar-light bg-light'>";
    echo make_menu(...prepareMenu($menu));
    echo "</nav>";
} else {
    echo "<h1>Hello Guest</h1>";
}
?>

</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>