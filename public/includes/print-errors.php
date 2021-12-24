
<?php
if(isset($_GET['alert'])){
    print('<div class="alert alert-danger" role="alert">');
    print(htmlspecialchars(strip_tags($_GET['alert'])));
    print('</div>');
}
?>