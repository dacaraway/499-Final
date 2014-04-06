<html>
    <head>
        <title>DVD Add</title>
    </head>
    <body>

    <?php
    if(Session::has('success')): ?>
    <div align = "center" style="background-color:green;width:300px;height:25px;border:1px solid #000">
        <font font color="white">
        <?php
        echo Session::get('success');
        endif; ?>
        </font>
    </div>

    <?php
    if(Session::has('errors')): ?>
    <div align = "center" style="background-color:red;width:200px;height:50px;border:1px solid #000">
        <font font color="white">
            <?php
            echo Session::get('errors');
            endif; ?>
        </font>
    </div>

    <form method ="post" action="/dvds">
        <div align='center'>
    Movie Title:
        <input  type= "text" name="title" value = "<?php echo Input::old('title'); ?>"/>
        </div>
        <div align='center'>
            <select name = "ratings" />
                <?php
                foreach($ratings as $line){
                    if($line->id == Input::old('ratings')){
                        echo '<option selected value='.$line->id.'>'.$line->rating_name.'</option>';
                    }
                    else{
                        echo '<option value='.$line->id.'>'.$line->rating_name.'</option>';
                    }
                }
                $i = -1;
                if(Input::old('ratings') == -1){
                    echo '<option value='.$i.'selected = "selected">'."ALL".'</option>';
                }
                echo '<option value='.$i.'>'."ALL".'</option>';
                ?>
</select>
</div>
        <div align='center'>
            <select name = "genres" selected = "<?php echo Input::old('genres'); ?>">
                <?php
                foreach($genres as $line){
                    if($line->id == Input::old('genres')){
                        echo '<option selected value='.$line->id.'>'.$line->genre_name.'</option>';
                    }
                    else{
                        echo '<option value='.$line->id.'>'.$line->genre_name.'</option>';
                    }
                }
                $i = -1;
                if(Input::old('genres') == -1){
                    echo '<option value='.$i.'selected = "selected">'."ALL".'</option>';
                }
                echo '<option value='.$i.'>'."ALL".'</option>';
                ?>
            </select>
        </div>

        <div align='center'>
            <select name = "labels" selected = "<?php echo Input::old('labels'); ?>">
                <?php
                foreach($labels as $line){
                    if($line->id == Input::old('labels')){
                        echo '<option selected value='.$line->id.'>'.$line->label_name.'</option>';
                    }
                    else{
                        echo '<option value='.$line->id.'>'.$line->label_name.'</option>';
                    }
                }
                ?>
            </select>
        </div>
            <div align='center'>
                <select name = "sounds" selected = "<?php echo Input::old('sounds'); ?>">
                    <?php
                    foreach($sounds as $line){
                        if($line->id == Input::old('sounds')){
                            echo '<option selected value='.$line->id.'>'.$line->sound_name.'</option>';
                        }
                        else{
                            echo '<option value='.$line->id.'>'.$line->sound_name.'</option>';
                        }
                    }
                        ?>
                </select>
            </div>
            <div align='center'>
                <select name = "formats" selected = "<?php echo Input::old('formats'); ?>">
                    <?php
                    foreach($formats as $line){
                        if($line->id == Input::old('formats')){
                            echo '<option selected value='.$line->id.'>'.$line->format_name.'</option>';
                        }
                        else{
                            echo '<option value='.$line->id.'>'.$line->format_name.'</option>';
                        }
                    }
                    ?>
                </select>

            <div align='center'>
                <input type = "submit" value = "Add Movie"/>
            </div>
</form>

</body>


</html>