<?php
/**
 * Created by PhpStorm.
 * User: Hudson
 * Date: 10/29/18
 * Time: 5:28 PM
 */

try {
    require "config.php";
    require "common.php";
    require "connection.php";

    $sql = "SELECT organization_id, organization_name, location, email FROM organizations";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "header.php"; ?>

<style>

    #header2 {
        position: relative;
        left: 5%;
    }

    table {
        width: 80%;
        position: relative;
        left: 5%;
    }

    th {


    }

    td {

        padding: 10px;
    }

    .b {
        position: relative;
        top: 40px;
    }
</style>

<div class="page-header header">
    <h1>Organizations</h1>
</div>

<div class="bodyText">
    <table>
        <thead class="tableHeader">
        <tr>
            <!-- <th>#</th> -->
            <th>Name</th>
            <th>Location</th>
            <th>Email Address</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <!-- <td><?php echo escape($row["id"]); ?></td> -->
                <td><a href="view_org.php?id=<?php echo escape($row['organization_id']); ?>"><?php echo escape($row["organization_name"]); ?></td>
                <td><?php echo escape($row["location"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<button><a href="events.php">Previous Page</a></button>
