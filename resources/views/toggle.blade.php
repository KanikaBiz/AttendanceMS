<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    /* body {
      background: #485461;
      background-image: linear-gradient(315deg, #485461 0%, #28313b 74%);
      font-family: sans-serif;
      height: 100vh;
      overflow: hidden;
    } */

    /* ▼.container {
      margin: 0 auto;
      text-align: center;
      padding-top: 30px;
      color: white;
    } */

    input[type=checkbox].toggle {
      display: none;
    }

    input[type=checkbox].toggle+label {
      display: inline-block;
      height: 60px;
      width: 200px;
      position: relative;
      font-size: 20px;
      border: 4px solid rgb(236, 6, 6);
      padding: 0;
      margin: 0;
      cursor: pointer;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    input[type=checkbox].toggle+label:before {
      position: absolute;
      top: 4px;
      height: 44px;
      width: 44px;
      content: '';
      transition: all 0.3s ease;
      z-index: 3;
      background-color: rgb(236, 6, 6);
    }

    input[type=checkbox].toggle+label:after {
      width: 140px;
      text-align: center;
      z-index: 2;
      text-transform: uppercase;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      text-overflow: ellipsis;
      overflow: hidden;
    }

    input[type=checkbox].toggle+label.rounded {
      border-radius: 30px;
    }

    input[type=checkbox].toggle+label.rounded:before {
      border-radius: 50%;
    }

    /* input[type=checkbox].toggle+label.android {
      height: 20px;
      border-radius: 30px;
      width: 150px;
      border-width: 0;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    input[type=checkbox].toggle+label.android:before {
      border-radius: 50%;
      top: -20px;
      height: 60px;
      width: 60px;
      background-color: white;
      box-shadow: 0 0 15px #333;
    }

    input[type=checkbox].toggle+label.android:after {
      display: none;
    }

    input[type=checkbox].toggle+label.android:active:before {
      box-shadow: 0 0 2px 15px rgba(48, 48, 48, 0.7);
      transition: all 0.1s ease;
    } */

    input[type=checkbox].toggle:not(:checked)+label {
      background-color: transparent;
      text-align: right;
    }

    input[type=checkbox].toggle:not(:checked)+label:after {
      content: attr(data-unchecked);
      right: 0;
      left: auto;
      opacity: 1;
      color: rgb(17, 0, 255);
    }

    input[type=checkbox].toggle:not(:checked)+label:before {
      left: 4px;
      background-color: #28a745;
    }

    /* input[type=checkbox].toggle:not(:checked)+label.android {
      background-color: white;
      border-color: white;
    }

    input[type=checkbox].toggle:not(:checked)+label.android:before {
      left: 0;
      background-color: white;
    } */

    input[type=checkbox].toggle:checked+label {
      text-align: left;
      border-color: yellow;
    }

    input[type=checkbox].toggle:checked+label:after {
      content: attr(data-checked);
      left: 4px;
      right: auto;
      opacity: 1;
      color: rgb(55, 0, 255);
    }

    input[type=checkbox].toggle:checked+label:before {
      left: 144px;
      background-color: dc3545;
      color: rgb(55, 0, 255);
    }

    /* input[type=checkbox].toggle:checked+label.android {
      background-color: white;
      border-color: white;
    }

    input[type=checkbox].toggle:checked+label.android:before {
      right: auto;
      left: 90px;
      |
    } */
  </style>
</head>

<body>
  <div class="container">
    {{-- <div>
      <input type="checkbox" name="default" id="default" class="toggle">
      <label for="default" data-checked="Checked" data-unchecked="Unchecked"></label>
    </div>
    <div> --}}
    <input type="checkbox" name="rounded" id="rounded" class="toggle">
    <label for="rounded" class="rounded" data-checked="Checked" data-unchecked="Unchecked"></label>
  </div>
  {{-- <div>
      <input type="checkbox" name="android" id="android" class="toggle">
      <label for="android" class="android"></label>
    </div> --}}
  </div>
</body>

</html>
