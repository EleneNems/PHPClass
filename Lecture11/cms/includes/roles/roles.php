<div>Roles - <a href="?nav=role&action=add">დამატება</a></div>

<?php
    $q_roles = "SELECT * FROM roles";
    $result = mysqli_query($conn, $q_roles);

    // $row_roles = mysqli_fetch_assoc($result);
    // echo "<pre>";
    // print_r($row_roles);
    // // print_r($result);
    // echo "</pre>";
?>

<?php
    if(isset($_GET['action']) && $_GET['action']=="add"){
        include "includes/roles/insert.php";
    }
    else if(isset($_GET['drop'])){
        $id = $_GET['drop'];
        mysqli_query($conn, "DELETE FROM roles WHERE ID = '$id'");
        header("location: ?nav=role");
    }else if(isset($_GET['edit'])){
        include "includes/roles/edit.php";
    }

?>

<table class="datatable">
    <tr>
        <th>Id</th>
        <th>Type</th>
        <th>Created_at</th>
        <th>Action</th>
    </tr>
    
    <?php
        while ( $row_roles = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?=$row_roles['id']?></td>
            <td><?=$row_roles['status']?></td>
            <td><?=$row_roles['created_at']?></td>
            <td>
                <a href="?nav=role&edit=<?=$row_roles['id']?>">Edit</a>  
                <a href="?nav=role&drop=<?=$row_roles['id']?>">drop</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>