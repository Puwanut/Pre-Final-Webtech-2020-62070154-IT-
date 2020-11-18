<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-3">
        <form action="index.php" method="get">
            <p>ระบุคำค้นหา</p>
            <div class="row ">
                <input type="text" style="width: 80%" name="searchtext" id="searchtext">
                <button type="submit" class="btn btn-primary ml-1">ค้นหา</button>
            </div>
        </form>

        <div class="row justify-content-center">

        <?php
            $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
            $response = file_get_contents($url);
            $result = json_decode($response);

            if (isset($_GET['submit'])){
                $text = $_GET['searchtext'];
                foreach ($result->tracks->items as $item){
                    $name = $item->name;
                    $artist = $item->artists[0]->name;
                    if (strpos($text, $name) || strpos($text, $artist)) {
                        echo '<div class="card m-2" style="width: 30%">
                        <img class="card-img-top" src="' . $item->album->images[0]->url . '">
                        <div class="card-body">
                            <h3>' . $item->name . '</h3>
                            <p>Artist: ' . $item->artists[0]->name . '</p>
                            <p>Release date: ' . $item->album->release_date. '</p>
                            <p>Avaliable: ' . count($item->available_markets) . ' countries</p>
                        </div>
                    </div>';
                    }
                }
            }else {
                foreach ($result->tracks->items as $item){
                    echo '<div class="card m-2" style="width: 30%">
                    <img class="card-img-top" src="' . $item->album->images[0]->url . '">
                    <div class="card-body">
                        <h3>' . $item->name . '</h3>
                        <p>Artist: ' . $item->artists[0]->name . '</p>
                        <p>Release date: ' . $item->album->release_date . '</p>
                        <p>Avaliable: ' . count($item->available_markets) . ' countries</p>
                    </div>
                </div>';
                }
            }
        ?>
        </div>
    </div>


</body>
</html>