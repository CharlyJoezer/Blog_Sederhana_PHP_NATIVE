<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/<?= $data['css']?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
  </head>
  <body>