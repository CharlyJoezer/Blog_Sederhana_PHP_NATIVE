<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/<?= $data['css']?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script
    src="https://code.jquery.com/jquery-3.6.4.js"
    integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
    <title><?= $data['title']; ?></title>
    <style>
      .navbar{
          box-shadow: 0 0 5px #ccc;
          position: sticky;
          top: 0;
          z-index: 1;
      }
      .input-gambar-label{
        width: 100%;
        box-sizing: border-box;
        height: 50%;
      }
      .input-gambar{
        opacity: 0;
      }
      .file-input-container {
        position: relative;
        width: 100%;
        height: 200px;
        border: 2px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
      }

      .file-input-label {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f7f7f7;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }

      .file-input-label:hover {
        background-color: #eee;
      }

      .file-input {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        cursor: pointer;
      }
      body{background:#ECF0F1}
      .wrapper-load{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background-color: white;
      }
      .load{position:fixed;top:50%;left:50%;transform:translate(-50%, -50%);
        /*change these sizes to fit into your project*/
        width:100px;
        height:100px;
        z-index: 2;
      }
      .load hr{border:0;margin:0;width:40%;height:40%;position:absolute;border-radius:50%;animation:spin 2s ease infinite}

      .load :first-child{background:#19A68C;animation-delay:-1.5s}
      .load :nth-child(2){background:#F63D3A;animation-delay:-1s}
      .load :nth-child(3){background:#FDA543;animation-delay:-0.5s}
      .load :last-child{background:#193B48}

      @keyframes spin{
        0%,100%{transform:translate(0)}
        25%{transform:translate(160%)}
        50%{transform:translate(160%, 160%)}
        75%{transform:translate(0, 160%)}
      }
    </style>
  </head>
  <body>