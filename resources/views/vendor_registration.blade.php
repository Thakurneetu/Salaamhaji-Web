<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>
    <style>
        /* Dark Theme Styles */
        body {
            font-family: sans-serif;
            background-color: #121212; /* Dark background */
            color: #ffffff; /* White text */
            margin: 0;
            padding: 100px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #222222; /* Darker container background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            color: #0EFF06; /* Purple accent color */
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            color: #eeeeee;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="file"],
        textarea {
            width: 95%;
            padding: 12px;
            border: 1px solid #444444; /* Darker border */
            border-radius: 4px;
            background-color: #333333; /* Input background */
            color: #ffffff;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        select {
            width: 99%;
            padding: 12px;
            border: 1px solid #444444; /* Darker border */
            border-radius: 4px;
            background-color: #333333; /* Input background */
            color: #ffffff;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="select"]:focus,
        input[type="file"]:focus,
        select:focus,
        textarea:focus {
            border-color: #bb86fc; /* Purple focus border */
            outline: none;
            box-shadow: 0 0 5px rgba(187, 134, 252, 0.3);
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            background-color: #0EFF06; /* Purple button */
            color: #000;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #09b003; /* Darker purple on hover */
        }

        .error-message {
            color: #f44336;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Vendor Registration</h1>
        <form action="#" method="post">

            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="form-group">
                <label for="address1">Address Line 1:</label>
                <input type="text" id="address1" name="address1" placeholder="Enter address line one" required>
            </div>

            <div class="form-group">
                <label for="address2">Address Line 2:</label>
                <input type="text" id="address2" name="address2" placeholder="Enter address line two">
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" placeholder="Enter city" required>
            </div>

            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" placeholder="Enter state" required>
            </div>

            <div class="form-group">
                <label for="zip">Zipcode:</label>
                <input type="text" id="zip" name="zip" placeholder="Enter zipcode" required>
            </div>

            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" placeholder="Enter country" required readonly>
            </div>

            <div class="form-group">
                <label for="services">Service Provided by you:</label>
                <select name="services" id="services">
                  <option value="" selected disabled>Select Your Service</option>
                  <option value="Laundry" >Laundry</option>
                  <option value="Food" >Food</option>
                  <option value="CAB" >CAB</option>

                </select>
            </div>

            <div class="form-group">
                <label for="catalogue">Service Catalogue:</label>
                <input type="file" id="catalogue" name="catalogue" required>
            </div>

            <!-- <button type="submit">Register</button> -->
            <a href="{{url('/success')}}"><button type="button">Register</button></a>

        </form>
    </div>

</body>
</html>