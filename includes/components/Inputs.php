<?php 



   function spawnCheckbox(String $id="",String $name="",String $val="", String $text="",$checked = false,$disabled = false){?>

      <label <?php echo ($id)?"for=$id":"" ?> class="checkbox-group">

            <input type="checkbox" <?php echo ($name)?"name=$name":"" ?> <?php echo ($id)?"id=$id":"" ?> value="<?php echo $val ?>" <?php echo ($checked)?"checked":"" ?> <?php echo ($disabled)?"disabled":"" ?>>
            <span><?php echo $text ?></span>

      </label>



<?php } ?>