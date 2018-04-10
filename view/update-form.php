<?php require_once 'model/ContactsGateway.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        Update Form
        </title>
    </head>
    <body>
        
        <?php 

         ?>
        <form method="POST" action="">
            <label for="name">Name:</label><br/>
            <input type="text" name="name" value="<?php echo $_GET['na']; ?>"/>
            <br/>
            
            <label for="phone">Phone:</label><br/>
            <input type="text" name="phone" value="<?php echo $_GET['ph']; ?>"/>
            <br/>
            <label for="email">Email:</label><br/>
            <input type="text" name="email" value="<?php echo $_GET['em']; ?>" />
            <br/>
            <label for="address">Address:</label><br/>
            <textarea name="address"><?php echo $_GET['add']; ?></textarea>
            <br/>
            <input type="hidden"  value="1" />
            <input type="submit" name="form-update" value="Update" />
        </form>
        
    </body>
</html>
