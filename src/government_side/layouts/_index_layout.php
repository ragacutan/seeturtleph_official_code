<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PawiCan - Login</title>
   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-pawican.png">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #4070f4;
    }

    .wrapper {
      position: relative;
      display: flex;
      max-width: 1000px; /* Adjusted max-width */
      width: 100%;
      background: #fff;
      padding: 40px; /* Adjusted padding */
      border-radius: 10px; /* Adjusted border-radius */
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .illustration {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .illustration img {
      max-width: 100%;
      height: auto;
    }

    .form-container {
      flex: 1;
      padding-left: 40px; /* Adjusted padding */
    }

    .wrapper h2 {
      position: relative;
      font-size: 28px; /* Adjusted font-size */
      font-weight: 600;
      color: #333;
    }

    .wrapper h2::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 28px;
      border-radius: 12px;
      background: #4070f4;
    }

    .wrapper form {
      margin-top: 30px;
    }

    .wrapper form .input-box {
      margin-bottom: 20px; /* Adjusted margin */
    }

    form .input-box label {
      font-size: 16px; /* Adjusted font-size */
      font-weight: 500;
      color: #333;
      display: block;
      margin-bottom: 8px; /* Adjusted margin */
    }

    form .input-box input {
      height: 100%;
      width: 100%;
      outline: none;
      padding: 10px 15px; /* Adjusted padding */
      font-size: 16px; /* Adjusted font-size */
      font-weight: 400;
      color: #333;
      border: 2px solid #C7BEBE;
      border-bottom-width: 3px; /* Adjusted border-bottom-width */
      border-radius: 8px; /* Adjusted border-radius */
      transition: all 0.3s ease;
    }

    .input-box input:focus,
    .input-box input:valid {
      border-color: #4070f4;
    }

    form .policy {
      display: flex;
      align-items: center;
      margin-bottom: 20px; /* Adjusted margin */
    }

    form h3 {
      color: #707070;
      font-size: 16px; /* Adjusted font-size */
      font-weight: 500;
      margin-left: 12px; /* Adjusted margin-left */
    }

    .input-box.button input {
      color: #fff;
      letter-spacing: 1px;
      border: none;
      background: #4070f4;
      cursor: pointer;
    }

    .input-box.button input:hover {
      background: #0e4bf1;
    }

    form .text h3 {
      color: #333;
      width: 100%;
      text-align: center;
      font-size: 16px; /* Adjusted font-size */
    }

    form .text h3 a {
      color: #4070f4;
      text-decoration: none;
    }

    form .text h3 a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
  .wrapper {
    flex-direction: column;
    margin: 20px; /* Add margin to the wrapper */
  }

  .illustration {
    order: 2;
  }

  .form-container {
    order: 1;
    padding-left: 0;
  }
}

  </style>
</head>