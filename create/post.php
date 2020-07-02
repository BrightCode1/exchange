<?php
    date_default_timezone_set('Europe/Copenhagen');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
            --color: #e40046;

        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a {
            text-decoration: none;
        }

        body {
            font-family: sans-serif;
            background: #eee;
        }

        .create-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        .create {
            background: var(--color);
            padding: 10px 20px;
            border-radius: 0px 15px 0px 15px;
            color: #fff;
            text-align: center;
            box-shadow: 2px 2px 0px 0px rgba(255,255,255,.7),
                4px 4px 0px 0px var(--color),
                6px 6px 0px 0px rgba(255,255,255,.7),
                8px 8px 0px 0px var(--color);
        }

        .create form div {
            display: flex;
            margin-top: 15px;
        }

        .create h1 {
            font-weight: bold;
            font-size: 30px;
            font-variant-caps: small-caps;
            margin: 5px 0 0;
        }

        .create p {
            font-weight: bold;
            font-variant: small-caps;
            font-size: 10px;
            color: #eee;
            letter-spacing: 1.5px;
        }

        .create .create-title,
        .create select {
            padding: 10px;
            outline: none;
            border: 0;
            border-radius: 0px 5px 0px 5px;
            color: var(--color);
            width: 100%;
            font-weight: bold;
        }
        
        .create .create-title::placeholder {
            color: #000;
        }

        .create select {
            color: #000;
            font-weight: bold;
            margin: 3px;
        }

        .create textarea {
            padding: 10px;
            width: 100%;
            max-width: 100%;
            max-height: 100px;
            margin-bottom: 0px;
            border-radius: 0px 10px 0px 10px;
            outline: none;
            font-weight: bold;
            color: var(--color);
            height: 80px;
            border: 0;
        }

        .create-btn {
            width: 50%;
            padding: 10px;
            border: 0;
            font-weight: bold;
            letter-spacing: 1px;
            background: #fff;
            color: var(--color);
            font-family: sans-serif;
            font-size: 16px;
            border-radius: 0px 5px 0px 5px;
            margin-top: 0px;
            margin-bottom: 10px;
            cursor: pointer;
            margin: 5px;
        }
        .create-btn:last-child {
            color: #fff;
            background: #1c1c1c;
        }

        ::placeholder {
            font-weight: bold;
            font-family: sans-serif;
        }

        .btnfile {
            border: 0;
            padding: 10px;
            outline: none;
            font-weight: bold;
            border-radius: 0px 5px 0px 5px;
        }

        .filename {
            margin-left: 5px;
            color: #fff;
            margin-top: 10px;
            font-size: 14px;
        }
        @media(max-width: 550px) {
            .create-wrapper {
                width: 90%;
            }
        }
        .count {
            float: right;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="create-wrapper">
        <div class="create">
            <form action="../getInfo/post.inc.php" method="post" enctype="multipart/form-data">
                <h1>Create A Post</h1>
                <p>Create To Trade</p>
                <div>
                    <input type="text" name="title" class="create-title" placeholder="I want to trade...">
                </div>
                <div>

                    <select name="category" class="create-category">
                        <option>Category</option>
                        <option value="fashion">Fashion</option>
                        <option value="phones">Phones & Tablet</option>
                        <option value="Electronics">Electronics</option>
                        <option value="home">Home & Office</option>
                        <option value="Animal">Animal & Pets</option>
                        <option value="Health">Health & Beauty</option>
                        <option value="Grocery">Grocery</option>
                        <option value="games">Games & Computers</option>
                        <option value="Toys">Toys & Baby Product</option>
                        <option value="Books">Books & Instruments</option>
                        <option value="vehicle">Vehicle</option>
                    </select>
                    <select name="tradeFor" class="create-category">
                        <option>Exchange For: </option>
                        <option value="Anything">Anything</option>
                        <option value="fashion">Fashion</option>
                        <option value="phones">Phones & Tablet</option>
                        <option value="Electronics">Electronics</option>
                        <option value="home">Home & Office</option>
                        <option value="Animal">Animal & Pets</option>
                        <option value="Health">Health & Beauty</option>
                        <option value="Grocery">Grocery</option>
                        <option value="games">Games & Computers</option>
                        <option value="Toys">Toys & Baby Product</option>
                        <option value="Books">Books & Instruments</option>
                        <option value="vehicle">Vehicle</option>
                    </select>
                </div>
                <div>
                    <input type="file" name="file_P" id="createFile" hidden>
                    <input type="button" id="btnfile" onclick="btnFile()" class="btnfile btn-secondary" value="Upload Product Photo">
                    <input type="hidden" name="pDate" value="<?php echo date("Y-m-d H:i") ?>">
                    <span id="createFilename" class="filename">No Files Chosen</span>
                </div>
                <div>
                    <textarea name="create-desc" placeholder="Describe the Product you want to trade! (Should be Greater Than 100 Letters)"></textarea>
                </div>
                    <p class="count"><span class="no">100</span>/100</p>
                <div>
                    
                <button type="submit" name="submitP" class="create-btn">Trade</button>
                <a href="../index.php" class="create-btn">Cancel</a>
                </div>

            </form>
        </div>
    </div>


    <script>
        const inputFile = document.querySelector("#createFile");
        const fileName = document.querySelector("#createFilename");


        function btnFile() {
            inputFile.click();
        }
        inputFile.addEventListener('change', function() {
            if (inputFile.value) {
                fileName.innerHTML = inputFile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else {
                inputFile.innerHTML = "No Files Chosen";
            }
        });
    </script>
    <script>
        const texa = document.querySelector('textarea');
        const no = document.querySelector('.no');
        const count = document.querySelector('.count');
        texa.addEventListener('input', () => {
            no.innerHTML =  100 - texa.value.length;
        if(texa.value.length > 10) {
            console.log('hello');
        }
        if(texa.value.length >= 100) {
            no.innerHTML = '0';
            count.style.color = "yellow";
        }
        })
    </script>
</body></html>