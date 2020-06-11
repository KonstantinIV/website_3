<?php 
namespace src\Model;
use \src\controller\core;
class AvatarModel extends core\Model{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    
  

    function replaceAvatar($image,$username,$imageExtension){
        $stmt = $this->pdo->prepare('UPDATE user SET  avatar_path = :avatarPath  WHERE username = :username ');
            
        $filename = $imageExtension;
        $stmt->bindParam(':avatarPath', $filename, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);


        if(!$stmt->execute()){
            return false;
        }

        $this->deleteAvatar($username);

        move_uploaded_file($image["tmp_name"],"/var/www/html/i/".$username.".".$imageExtension);

    }

    function getAvatarPath($username){
        $stmt = $this->pdo->prepare('select avatar_path from user where username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }
    function deleteAvatar($username){
        $extensions = array("jpg","png","jpeg","PNG");
        foreach($extensions as $extension){
            unlink("/var/www/html/i/".$username.".".$extension);
        }
    }
}
?>
