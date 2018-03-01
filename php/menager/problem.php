
<button type="button" id="resultProblem" style="width:100%;" class="btn btn-info">統計結果</button>
<table align="center" style="width:100%;text-align:center;">
    <th>編號</th>
    <th width="50%">標題</th>
    <th width="40%">選項</th>
<?php
    if(empty($_SESSION))
        session_start();
    include_once("../pdoLink.php");
    $problemTitle = [];
    $problemOption = [];
    $result=$db->prepare("SELECT * FROM problem");
    $result->execute();
    $n = 1;
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        $problemTitle[count($problemTitle)] = $record['p_title'];
        $problemOption[count($problemOption)] = $record['p_option'];
         ?>
            <tr>
                <td><?php echo $n.'.';?></td>
                <td><?php echo $record['p_title'];?></td>
                <td>
                    <?php
                        $data = explode(',',$record['p_option']);
                        foreach($data as $value){
                            echo $value."<br>";
                        }
                    ?>
                </td>
                <td>
                    <a href="#">
                        <button type="button" class="btn btn-warning">修改</button>
                    </a>
                    <a href="#" onclick="return checkDel('menager/deleteProduct.php?id=<?php echo $row['p_id'];?>')">
                        <button type="button" class="btn btn-danger">刪除</button>
                    </a>
                
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <?php $n++; } ?>
            <div class="modal fade" id="viewMoreModal<?php echo $row['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title"><?php echo $row['p_item'];?></h4>
                        </div>
                        <div class="modal-body" style="font-size:20px;">
                            <img width="100%" src="../<?php echo $row['p_img'];?>"><br>
                            <?php 
                                if($row['p_price']==''){
                                    $other = $row['p_other'];
                                    $items = explode('/',$other);
                                    foreach ($items as $item) {
                                        $keys = explode(':',$item);
                                        echo $keys[0]."<br>";
                                        $keys = explode(',',$keys[1]);
                                        foreach($keys as $value){
                                            $res = explode('...',$value);
                                            echo $res[0]."：".$res[1]."元<br>";
                                        }
                                    }
                                }else{
                                    echo "價格：".$row['p_price'];

                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
</table>
<div class="modal fade" id="viewProblemResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">問卷統計結果</h4>
            </div>
            <div class="modal-body" style="font-size:20px;">
                <?php 
                    for($i = 0 ; $i<count($problemOption);$i++){
                        echo $problemTitle[$i]."<br>";
                        $option = explode(',',$problemOption[$i]);
                        foreach($option as $opt){
                            $sql = "select count(*) from problem_record where p_title = :title and p_solution = :opt";
                            $select = $db->prepare($sql);
                            $select->bindValue(':opt',$opt);
                            $select->bindValue(':title',$problemTitle[$i]);
                            $select->execute();
                            $n = $select->fetch(PDO::FETCH_NUM)[0];
                            ?>
                            <table width="100%">
                                <tr>
                                    <td><div style="text-align:left"><?php echo $opt;?></div></td>
                                    <td><div style="text-align:right"><?php echo $n;?></div></td>
                                </tr>
                            </table>
                                
                                
                            <?php
                        }
                        echo "<hr>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function viewMore(id){
        $('#viewMoreModal'+id).modal('toggle');
        return false;
    }
    $("#resultProblem").click(function(){
        $("#viewProblemResult").modal('toggle');
    });
</script>