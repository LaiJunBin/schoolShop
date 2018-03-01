<?php
    include_once('./pdoLink.php');
    if(!isset($_SESSION))
        session_start();
    $user = $_SESSION['loginUser'];
    $sql = 'select Distinct(o_code) from order_table where o_user = :user';
    $select = $db->prepare($sql);
    $select->bindValue(':user',$user);
    $select->execute();
    while ($code = $select->fetch(PDO::FETCH_ASSOC)['o_code']){
        ?>
        <table style="width:100%;text-align:center;">
            <th>狀態</th>
            <th>訂單編號</th>
            <th width="40%">詳細</th>
            <tr>
                <td>
                    <?php 
                        $sql = 'select * from order_status where o_code = :code';
                        $orderStatus = $db->prepare($sql);
                        $orderStatus->bindValue(':code',$code);
                        $orderStatus->execute();
                        $orderStatus = $orderStatus->fetch(PDO::FETCH_ASSOC);
                        echo $orderStatus['o_status'];
                        if($orderStatus['o_pay']=='T'){ ?>
                            <div style="color:blue">已付款</div>
                        <?php }else{ ?>
                            <div style="color:red;" class="payDiv<?php echo $code;?>">未付款</div>
                        <?php }
                    ?>
                </td>
                <td><?php echo $code;?></td>
                <td>
                    <button type="button" class="btn btn-success orderRecordBtn" va="<?php echo $code;?>">詳細</button>
                    <?php
                        if($orderStatus['o_status']=='已完成'){ ?>
                            <button type="button" class="btn btn-info writeProblem" va="<?php echo $code;?>">填問卷</button>
                            <div style="height: 100vh;" class="modal fade" id="problem<?php echo $code;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close closeProblem" va="<?php echo $code;?>" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">填寫問卷</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $sql = 'select * from problem';
                                                $problemQuery = $db->prepare($sql);
                                                $problemQuery->execute();
                                                while($problem = $problemQuery->fetch(PDO::FETCH_ASSOC)){
                                                    $title = $problem['p_title'];
                                                    $optionData = $problem['p_option'];
                                                    $data = explode(',',$optionData);
                                                    echo "<div>$title ：</div>";
                                                    foreach($data as $opt){
                                                    ?>
                                                        <input type="radio"<?php if($opt==$data[0]){ ?> required <?php } ?> name="<?php echo $title;?>"><?php echo $opt;?>

                                                <?php
                                                    }
                                                }
                                            ?>
                                            
                                            <button type="button" style="width:100%;" class="btn btn-primary">送出問卷</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </td>
            </tr>
        </table>
        <div style="height:100vh;" class="modal fade" id="orderRecord<?php echo $code;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  aria-label="Close">
                            <span aria-hidden="true" va="<?php echo $code;?>" class="closeOrder">&times;</span>
                        </button>
                        <h4 class="modal-title">訂單編號 <?php echo $code;?></h4>
                    </div>
                    <div class="modal-body">
                        <table style="width:100%;text-align:center;">
                        <th>品項</th>
                        <th>種類</th>
                        <th>價錢</th>
                        <th>數量</th>
                        <th style="text-align:right;">合計</th>
                        <?php
                            $totalCoin = 0;
                            $sql = 'select * from order_table where o_code = :code';
                            $time = '';
                            $orderSelect = $db->prepare($sql);
                            $orderSelect->bindValue(':code',$code);
                            $orderSelect->execute();
                            $sql = 'select * from order_status where o_code = :code';
                            $status = $db->prepare($sql);
                            $status->bindValue(":code",$code);
                            $status->execute();
                            $statusObj = $status->fetch(PDO::FETCH_ASSOC);
                            while($order = $orderSelect->fetch(PDO::FETCH_ASSOC)){
                                $time = $order['o_reserve'];
                                $totalCoin += $order['o_price'] * $order['o_amount'];
                        ?>
                        <tr>
                            <td><?php echo $order['o_item'];?></td>
                            <td><?php echo $order['o_other'];?></td>
                            <td><?php echo $order['o_price'];?></td>
                            <td><?php echo $order['o_amount'];?></td>
                            <td><?php echo $order['o_price'] * $order['o_amount'];?></td>
                        </tr>
                            <?php } ?>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr style="width:100%;">
                                <td colspan="4" style="text-align:left">總計金額:</td>
                                <td  style="text-align:center"><?php echo $totalCoin;?></td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                        </table>
                        <div>預約取餐時間在 <?php echo $time;?></div>
                        <div>當前訂單狀態:<?php echo $statusObj['o_status'];?></div>
                        <?php if($statusObj['o_pay']=='T'){ ?>
                            <div style="color:blue">已付款</div>
                        <?php }else{ ?>
                            <div style="color:red;">未付款</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>