<ul class="list-unstyled spaced">
    <?php
    foreach($this->jsonObj as $row){
    ?>
    <li>
        <i class="ace-icon fa fa-cutlery bigger-110 green"></i>
        Vào lúc <b><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></b> - <b><?php echo $row['fullname'] ?></b> đã báo ăn: <b>Ăn chính - <?php echo $row['food_main'] ?></b>; <b>Ăn sáng - <?php echo $row['food_morning'] ?></b>
    </li>
    <?php
    }
    ?>
</ul>