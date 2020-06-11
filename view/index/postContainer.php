<div class="pop_post_cont">


<?php
/*var_dump($this->output);
var_dump($this->searchInput);*/
if(!$this->output && $this->searchInput ||$this->output && !$this->searchInput || $this->output && $this->searchInput || !$this->output && !$this->searchInput){
    require_once "posts.php";
?>

<?php
}else{
    //print_r("no resultsd");
    print_r("no results");

}
//(!$this->output && $this->search)  ? require_once "posts.php" : print_r("no results"); ?>
</div>