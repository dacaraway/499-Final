<!doctype html>
<html>
    <head>
        <title>My DVDS</title>
    </head>
    <body>

    <h1 align="center"> My DVDS</h1>
    <div>

        <table border="10" align ="center"  style="font-family: helvetica" cellspacing="10">
            <tr>
                <th style="color: blue">Title</th>
                <th style="color: blue">Rating</th>
                <th style="color: blue">Genre</th>
                <th style="color: blue">Label</th>
                <th style="color: blue">Sound</th>
                <th style="color: blue">Format</th>
                <th style="color: blue">Release Date</th>
            </tr>


        <?php foreach ($dvds as $movie) : ?>
        <div class = "movies">
            <tr>
                <td><?php echo $movie->title?> </td>
                <td><?php echo $movie->rating->rating_name; ?></td>
                <td><?php echo $movie->genre->genre_name; ?></td>
                <td> <?php
                    if($movie->label)echo $movie->label->label_name; ?></td>
                <td><?php if($movie->sound) echo $movie->sound->sound_name; ?></td>
                <td> <?php if($movie->format) echo $movie->format->format_name; ?></td>
                <td> <?php echo $movie->release_date; ?></td>
            </tr>
        </div>
    </div>
    <?php endforeach; ?>


    </body>

</html>