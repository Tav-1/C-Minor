<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "config.php";
require "common.php";


include "header.php";

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $profile =[
            "id"        => $_POST['id'],
            "fname"     => $_POST['fname'],
            "lname"     => $_POST['lname'],
            "email"     => $_POST['email'],
            "website"   => $_POST['website']
            "bio"       => $_POST['bio']
            "major"     => $_POST['major']
            "interests" => $_POST['interests']
        ];

        $sql = "UPDATE profiles 
            SET id = :id, 
              fname = :fname, 
              lname = :lname, 
              email = :email, 
              website = :website,
              bio = :bio,
              major = :major,
              interests = :interests
            WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($profile);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $sql = "SELECT * FROM profiles WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>


<?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['fname']); ?> successfully updated.</blockquote>
<?php endif; ?>

<div align="center">
    <?php
        if (isset($_GET['remarks']) && $_GET['remarks']=='imagesuccess')
        {
            echo 'Image Upload Success';
        }
    ?>
</div>

<body style="margin-left:2%">
    <h1>Edit Profile</h1>

    <h2>Image Upload</h2>

    <form action="upload_exec.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upFile" id="upFile">
        <input type="submit" name="submit" value="Upload Image">
    </form>

    <h2>Edit Information</h2>

    <form method = "post" action = "<?php $_PHP_SELF ?>">
      <table width = "600" border =" 0" cellspacing = "1" 
         cellpadding = "2">
      
         <tr>
            <td width = "100">First Name</td>
            <td><input name = "fname" type = "text" 
               id = "fname"></td>
         </tr>
      
         <tr>
            <td width = "100">Last Name</td>
            <td><input name = "lname" type = "text" 
               id = "lname"></td>
         </tr>
      
         <tr>
            <td width = "100">Email</td>
            <td><input name = "address" type = "text"
                id = "address"></td>
         </tr>

         <tr>
            <td width = "100">Website</td>
            <td><input name = "contact" type = "text"
                id = "contact"></td>
         </tr>

         <tr>
            <td width = "100">Biography</td>
            <td><textarea rows = "6" cols = "50" name = "bio" type = "text"
                id = "bio"></textarea></td>
         </tr>

         <tr>
            <td width = "100">Major</td>
            <td><input name = "major" type = "text"
                id = "major"></td>
         </tr>

         <tr>
            <td width = "100">Interests</td>
            <td><textarea rows = "4" cols = "50" name = "interests" type = "text"
                id = "interests"></textarea></td>
         </tr>
      
         <tr>
            <td width = "100"></td>
            <td>
               <input name = "update" type = "submit" 
                  id = "update" value = "Update">
            </td>
         </tr>
      
      </table>
   </form>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

</body>