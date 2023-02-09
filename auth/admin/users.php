<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';

// Return Users

$users = $conn->prepare("SELECT 
        
        u.id,
        u.username,
        u.is_active,
        u.email 
       FROM user u
        left join image img on u.id = img.fk_user_id
        left join album alb on img.fk_album_id = alb.id
     
");

$users->execute();
$users->store_result();
$users->bind_result( $uid, $username, $active, $email);
      ?>
<main class="users">
    <h2>ALL USERS</h2>
    <table>
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Email</th>
        
        <th>Active/Inactive</th>
    </tr>
    <?php while ($users->fetch()): ?>  
        <tr>
        <td><?= $uid ?></td>
        <td><?= $username ?></td>
        <td><?= $email ?></td>
        <td>
        <?php if($active == 1){
            print 'ACTIVE';
        }
        else{
            print 'INACTIVE';
        }
        ?>
    </td>
    <td>
        <?php 
        echo '<a href="editUser.php?uid='.$uid.'"><i style="color: grey; font-size: 22px; padding: 5px;" class="fas fa-user-edit"></i></a>';
		if($active == 1){
        	echo '<a href="deactivateUser.php?uid='.$uid.'"><i style="color: red; font-size: 22px; padding: 5px;" class="fas fa-times-circle"></i></a>'; // x
		}
		else{
			        echo '<a href="activateUser.php?uid='.$uid.'"><i style="color: green; font-size: 22px; padding: 5px;" class="fas fa-check-circle"></i></a>'; 

		}
        ?>
    </td>
    </tr>
    <?php endwhile; ?>
    
    </table>
</main>
<?php
include '../../partials/footer.php';
?>