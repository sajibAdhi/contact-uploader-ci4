<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= route_to('category.upload') ?>" method="post" enctype="multipart/form-data">
        <label for="file">Choose a csv file with header (category):</label>
        <input type="file" name="csv_file" id="file" accept=".csv">

        <button type="submit">Submit</button>
    </form>
</body>

</html>