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
        .text-danger{
          color:red;
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
            color: #0EFF06;
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
            border-color: #0EFF06; /* Purple focus border */
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
        <form action="{{route('vendor.registration')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Enter your full name" required>
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="{{old('phone')}}" placeholder="Enter your phone number" required>
                @error('phone')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email address" required>
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address1">Address Line 1:</label>
                <input type="text" id="address1" name="address1" value="{{old('address1')}}" placeholder="Enter address line one" required>
                @error('address1')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address2">Address Line 2:</label>
                <input type="text" id="address2" name="address2" value="{{old('address2')}}" placeholder="Enter address line two">
                @error('address2')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="{{old('city')}}" placeholder="Enter city" required>
                @error('city')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" value="{{old('state')}}" placeholder="Enter state" required>
                @error('state')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="zip">Zipcode:</label>
                <input type="text" id="zip" name="zip" value="{{old('zip')}}" placeholder="Enter zipcode" oninput="onlyNumber(this)"  required>
                @error('zip')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="country_id">Country:</label>
                <select name="country_id" id="country_id">
                  <option value="" selected disabled>Select Your Country</option>
                  @foreach($countries as $country)
                    <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ($country->id == 152 ? 'selected' : '')}}>{{$country->name}}</option>
                  @endforeach
                </select>
                @error('country_id')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="services">Service Provided by you:</label>
                <select name="services" id="services">
                  <option value="" selected disabled>Select Your Service</option>
                  <option value="Laundry" {{old('services') == "Laundry" ? 'selected' : ''}} >Laundry</option>
                  <option value="Food" {{old('services') == "Laundry" ? 'selected' : ''}}>Food</option>
                  <option value="CAB" {{old('services') == "Laundry" ? 'selected' : ''}}>CAB</option>
                </select>
                @error('services')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="catalogue">Service Catalogue:</label>
                <input type="file" id="catalogue" name="catalogue" required>
                @error('catalogue')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Register</button>

        </form>
    </div>

    <script>
      function onlyNumber(e) {
        var inputElement = e;
        var inputValue = inputElement.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
        inputElement.value = sanitizedValue;
      }
    </script>
</body>
</html>
