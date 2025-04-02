    <?php 

        $recupUser = $bdd->query('SELECT FROM user'); 
        while($user = $recupUser->fetch()){ 
        ?> 
        <a href=""><?php echo $user ['firstname']; ?></a> 
        <p> teste</p> 
        <?php 
        } 
?>
